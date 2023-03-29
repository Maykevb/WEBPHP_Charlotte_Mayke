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

        if ($account->count() > 0 && $account[0] != null) {
            $data['name'] = $name;
            $data['streetName'] = $street;
            $data['houseNumber'] = $nr;
            $data['postalCode'] = $code;
            $data['place'] = $place;
            $data['status'] = "Aangemeld";
            $temp = $this->repo->create($data);

            return [
                'id' => $temp['id'],
                'name' => $temp['name'],
                'street name' => $temp['streetName'],
                'house number' => $temp['houseNumber'],
                'postal code' => $temp['postalCode'],
                'place' => $temp['place'],
                'status' => "Aangemeld",
            ];
        }
        else {
            return [
                "Error: ongeldige account token of email."
            ];
        }
    }

    public function updateShipmentStatus($token, $email, $id, $newStatus) {
        $account = $this->accRepo->findByTokenAndEmail($token, $email);

        if ($account->count() > 0 && $account[0] != null)
        {
            $data = $this->repo->find($id);
            $data['status'] = $newStatus;

            $temp = $this->repo->update($data, $id);

            return [
                'id' => $temp['id'],
                'status' => $temp['status'],
            ];
        }
        else {
            return [
                "Error: ongeldige account token of email."
            ];
        }
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        if ($header[1] == 'name' && $header[2] == 'place' && $header[3] == 'streetName' &&
            $header[4] == 'houseNumber' && $header[5] == 'postalCode') {
            return $data;
        }
        else {
            return false;
        }
    }

    public function importCsv($filename)
    {
        $file = public_path("storage/files/{$filename}");
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
        if($request->filled('search') && isset($request->id_sort)) {
            $reviews = Review::search($request->search)
                ->where('account_id', Auth::user()->id)
                ->orderBy('id', $request->id_sort)
                ->paginate(8);
        }
        else if($request->filled('search') && isset($request->description_sort)) {
            $reviews = Review::search($request->search)
                ->where('account_id', Auth::user()->id)
                ->orderBy('text', $request->description_sort)
                ->paginate(8);
        }
        else if($request->filled('search') && isset($request->star_sort)) {
            $reviews = Review::search($request->search)
                ->where('account_id', Auth::user()->id)
                ->orderBy('stars', $request->star_sort)
                ->paginate(8);
        }
        else if($request->filled('search') && isset($request->order_sort)) {
            $reviews = Review::search($request->search)
                ->where('account_id', Auth::user()->id)
                ->orderBy('shipment_id', $request->order_sort)
                ->paginate(8);
        }
        else if($request->filled('search') && isset($request->date_sort)) {
            $reviews = Review::search($request->search)
                ->where('account_id', Auth::user()->id)
                ->orderBy('created_at', $request->date_sort)
                ->paginate(8);
        }
        else if($request->filled('search')) {
            $reviews = Review::search($request->search)
                ->where('account_id', Auth::user()->id)
                ->paginate(8);
        }
        else if(isset($request->id_sort)) {
            $reviews = $this->revRepo->getAllOrderBy('id', $request->id_sort);
        }
        else if(isset($request->description_sort)) {
            $reviews = $this->revRepo->getAllOrderBy('text', $request->description_sort);
        }
        else if(isset($request->star_sort)) {
            $reviews = $this->revRepo->getAllOrderBy('stars', $request->star_sort);
        }
        else if(isset($request->order_sort)) {
            $reviews = $this->revRepo->getAllOrderBy('shipment_id', $request->order_sort);
        }
        else if(isset($request->date_sort)) {
            $reviews = $this->revRepo->getAllOrderBy('created_at', $request->date_sort);
        }
        else {
            $reviews = Review::where('account_id', '=', Auth::user()->id)->paginate(8);
        }

        return view('/reviews', compact('reviews'));
    }
}

