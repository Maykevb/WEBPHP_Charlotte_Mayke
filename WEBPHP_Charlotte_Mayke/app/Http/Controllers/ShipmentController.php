<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Http\Resources\ShipmentResource;
use App\Repositories\AccountRepo;
use App\Repositories\ShipmentRepo;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;

class ShipmentController extends Controller
{
    private ShipmentRepo $repo;
    private AccountRepo $accRepo;

    public function __construct()
    {
        $this->repo = new ShipmentRepo();
        $this->accRepo = new AccountRepo();
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

//    TODO: needed?
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

//    TODO: needed?
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
        $shipment = $this->repo->find($id);

        $shipment = $this->repo->insertReview($request, $id);
        return view('/writeReview', [
            'shipment' => $shipment
        ]);
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return $shipment;
    }

    public function signUpShipment($username, $password, $name, $street, $nr, $code, $place) {
        $account = $this->accRepo->findByUsernameAndPassword($username, $password);

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
                "Error: foutieve inlog gegevens"
            ];
        }
    }

//    TODO: update label_id??
    public function updateShipmentStatus($username, $password, $id, $newStatus) {
        $account = $this->accRepo->findByUsernameAndPassword($username, $password);

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
                "Error: foutieve inlog gegevens"
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

        return $data;
    }

    public function importCsv($filename)
    {
        $file = public_path("storage/files/{$filename}");
        $shipmentArr = $this->csvToArray($file);

        if ($shipmentArr != null) {
            for ($i = 0; $i < sizeof($shipmentArr); $i++) {
                $temp = $this->repo->create($shipmentArr[$i]);
            }
        }
    }
}
