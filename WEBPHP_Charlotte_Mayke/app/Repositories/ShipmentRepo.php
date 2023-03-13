<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Shipment;

class ShipmentRepo implements CrudInterface
{
    public function getAll()
    {
        return Shipment::all();
    }

    public function find($id)
    {
        return Shipment::find($id);
    }

    public function delete($id)
    {
        Shipment::find($id)->delete();
    }

    public function create($data)
    {
        return Shipment::create($data);
    }

    public function update($data, $id)
    {
        $shipment = Shipment::where('id', $id)->first();
//        TODO
//        $shipment->label = $data['label'];
//        $shipment->request = $data['request'];
//        $shipment->status = $data['status'];
        $shipment->save();
    }
}

