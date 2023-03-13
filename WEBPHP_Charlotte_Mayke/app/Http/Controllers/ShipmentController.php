<?php

namespace App\Http\Controllers;

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

    public function signUpShipment($data) {
        return $this->repo->create($data);
    }

    public function updateShipmentStatus($id, $newStatus) {
        $data = $this->repo->find($id);
        $data['status'] = $newStatus;
        return $this->repo->update($data, $id);
    }
}

