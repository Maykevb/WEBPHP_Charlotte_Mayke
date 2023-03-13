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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'streetName' => 'required|string|max:50',
            'houseNumber' => 'required|integer',
            'postalCode' => 'required|string|max:6'
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
            'postalCode' => 'required|string|max:6'
        ]);

        $shipment->update($validated);
        return new ShipmentResource($shipment);
    }

//    TODO
    public function signUpShipment($street, $nr, $code) {
        $data = new Shipment();
        $data['streetName'] = $street;
        $data['houseNumber'] = $nr;
        $data['postalCode'] = $code;
        $data['status'] = "Aangemeld";
        $this->repo->create($data);

        return [
            'id' => 1,
            'streetName' => $street,
            'houseNumber' => $nr,
            'postalCode' => $code,
        ];
    }

    public function testing($street, $nr, $code) {
        return [
            'id' => 1,
            'streetName' => $street,
            'houseNumber' => $nr,
            'postalCode' => $code,
        ];
    }

    public function updateShipmentStatus($id, $newStatus) {
        $data = $this->repo->find($id);
        $data['status'] = $newStatus;
        $this->repo->update($data, $id);
    }
}

