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

//    TODO: name, status
    public function signUpShipment($name, $street, $nr, $code, $place) {
        $data['name'] = $name;
        $data['streetName'] = $street;
        $data['houseNumber'] = $nr;
        $data['postalCode'] = $code;
        $data['place'] = $place;
//        $data['status'] = "Aangemeld";
        $temp = $this->repo->create($data);

        return [
            'id' => $temp['id'],
            'name' => $temp['name'],
            'streetName' => $temp['streetName'],
            'houseNumber' => $temp['houseNumber'],
            'postalCode' => $temp['postalCode'],
            'place' => $temp['place'],
        ];
    }

//    TODO: update label_id??, return status
    public function updateShipmentStatus($id, $newStatus) {
        $data = $this->repo->find($id);
        $data['status'] = $newStatus;

        $temp = $this->repo->update($data, $id);

        return [
            'id' => $temp['id'],
//            'status' => $temp['status'],
        ];
    }
}

