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
//        $shipment->city = $data['city'];
//        $shipment->province = $data['province'];
//        $shipment->continent = $data['continent'];
//        $shipment->coordinate_y = $data['coordinate_y'];
//        $shipment->coordinate_x = $data['coordinate_x'];
        $shipment->save();
    }
}

