<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Http\Resources\ShipmentResource;
use App\Repositories\ShipmentRepo;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    private ShipmentRepo $repo;

    public function __construct()
    {
        $this->repo = new ShipmentRepo();
    }

    public function getAllShipments()
    {
        return $this->repo->getAll();
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

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return $shipment;
    }

    public function signUpShipment($name, $street, $nr, $code, $place) {
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

//    TODO: update label_id??
    public function updateShipmentStatus($id, $newStatus) {
        $data = $this->repo->find($id);
        $data['status'] = $newStatus;

        $temp = $this->repo->update($data, $id);

        return [
            'id' => $temp['id'],
            'status' => $temp['status'],
        ];
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

