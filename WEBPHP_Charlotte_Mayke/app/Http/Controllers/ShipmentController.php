<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shipment;
use App\Http\Resources\ShipmentResource;
use App\Repositories\AccountRepo;
use App\Repositories\ReviewRepo;
use App\Repositories\ShipmentRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use PHPUnit\Framework\Constraint\IsEmpty;

class ShipmentController extends Controller
{
    private ShipmentRepo $repo;
    private AccountRepo $accRepo;
    private ReviewRepo $revRepo;

    public function __construct()
    {
        $this->repo = new ShipmentRepo();
        $this->accRepo = new AccountRepo();
        $this->revRepo = new ReviewRepo();
    }

    public function getAllShipments()
    {
        return $this->repo->getAll();
    }

    public function findShipment(Request $request)
    {
        $id = $request->id;
        return view('/writeReview', [
            'shipment' => $this->repo->find($id)
        ]);
    }

    public function shipments()
    {
        return view('/myShipments');
    }

    public function getShipmentWithTandTCode(Request $request)
    {
        return view('/myShipments', [
            'shipments' => $this->repo->getShipmentsWithTandTCode($request)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'streetName' => 'required|string|max:50',
            'houseNumber' => 'required|integer',
            'postalCode' => 'required|string|max:6',
            'place' => 'required|string|max:50'
        ]);

        $shipment = new Shipment($validated);
        $this->repo->create($shipment);
        return new ShipmentResource($shipment);
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $request->validate([
            'streetName' => 'required|string|max:50',
            'houseNumber' => 'required|integer',
            'postalCode' => 'required|string|max:6',
            'place' => 'required|string|max:50'
        ]);

        $shipment->update($validated);
        return new ShipmentResource($shipment);
    }

    public function insertReview(Request $request) {
        $id = $request->id;
        $review = $this->revRepo->insertReview($request);

        return view('/writeReview', [
            'shipment' => $review
        ]);
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return $shipment;
    }

    public function signUpShipment($token, $email, $name, $street, $nr, $code, $place) {
        $account = $this->accRepo->findByTokenAndEmail($token, $email);

        if ($account != null) {
            $data['name'] = $name;
            $data['streetName'] = $street;
            $data['houseNumber'] = $nr;
            $data['postalCode'] = $code;
            $data['place'] = $place;
            $data['status'] = "Aangemeld";
            $data['webshop'] = $account->webshop;

            $temp = $this->repo->create($data);


            return response()->json([
                'id' => $temp['id'],
                'name' => $temp['name'],
                'street name' => $temp['streetName'],
                'house number' => $temp['houseNumber'],
                'postal code' => $temp['postalCode'],
                'place' => $temp['place'],
                'webshop' => $temp['webshop'],
                'status' => "Aangemeld",
            ], 200);
        }
        else {
            return [
                "Error: ongeldige account token of email of onvoldoende rechten."
            ];
        }
    }

    public function updateShipmentStatus($token, $email, $id, $newStatus) {
        $account = $this->accRepo->findByTokenAndEmailCompany($token, $email);

        if ($account->count() > 0 && $account[0] != null) {
            $data = $this->repo->find($id);
            $data['status'] = $newStatus;

            $temp = $this->repo->update($data, $id);

            return response()->json([
                'id' => $temp['id'],
                'status' => $temp['status'],
            ], 200);
        }
        else {
            return [
                "Error: ongeldige account token of email of onvoldoende rechten."
            ];
        }
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        if ($header[1] == 'name' && $header[2] == 'place' && $header[3] == 'streetName' &&
            $header[4] == 'houseNumber' && $header[5] == 'postalCode' && $header[6] == 'webshop') {
            return $data;
        }
        else {
            return false;
        }
    }

    public function importCsv($filename)
    {
        $file = storage_path("app\\public\\files\\{$filename}");
        $shipmentArr = $this->csvToArray($file);

        if ($shipmentArr != null) {
            for ($i = 0; $i < sizeof($shipmentArr); $i++) {
                $temp = $this->repo->create($shipmentArr[$i]);
            }
            return true;
        }
        else {
            return false;
        }
    }

    public function getAllReviews(Request $request)
    {
        $temp = null;
        if ($request->sorting != 0 && $request->sorting != null) {
            $temp = preg_split("/-+/", $request->sorting);
        }

        // Filter is used
        if ($request->filter != 0 && $request->filter != null) {
            if ($request->filled('search') && ($request->sorting != 0 && $request->sorting != null)) {
                $reviews = $this->revRepo->hasFilterSearchAndSort($request, $temp);
            }
            else if ($request->filled('search')) {
                $reviews = $this->revRepo->hasFilterAndSearch($request);
            }
            else if ($request->sorting != 0 && $request->sorting != null) {
                $reviews = $this->revRepo->getAllOrderByWithFilter($temp[0], $temp[1], $request->filter);
            }
            else {
                $reviews = $this->revRepo->hasFilter($request);
            }
        }

        // All Reviews
        else {
            if ($request->filled('search') && ($request->sorting != 0 && $request->sorting != null)) {
                $reviews = $this->revRepo->noFilterSearchAndSort($request, $temp);
            }
            else if ($request->filled('search')) {
                $reviews = $this->revRepo->noFilterAndSearch($request);
            }
            else if ($request->sorting != 0 && $request->sorting != null) {
                $reviews = $this->revRepo->getAllOrderBy($temp[0], $temp[1]);
            }
            else {
                $reviews = $this->revRepo->noFilter();
            }
        }

        $path = "?sorting={$request->sorting}&filter={$request->filter}&search={$request->search}";
        $reviews->withPath($path);
        return view('/reviews', compact('reviews'));
    }
}

