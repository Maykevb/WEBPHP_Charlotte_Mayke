<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Review;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

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
        $shipment->label_id = $data['label_id'];
        $shipment->streetName = $data['streetName'];
        $shipment->houseNumber = $data['houseNumber'];
        $shipment->postalCode = $data['postalCode'];
        $shipment->status = $data['status'];
        $shipment->pickUpRequest_id = $data['pickUpRequest_id'];
        $shipment->save();

        return $shipment;
    }

    public function getShipmentsWithTandTCode($request)
    {
        return Shipment::select('shipments.status', 'labels.trackAndTrace', 'shipments.id', 'reviews.stars')
            ->join('labels', 'labels.id', '=', 'shipments.label_id')
            ->leftjoin('reviews', 'reviews.shipment_id', '=', 'shipments.id')
            ->where('trackAndTrace', '=', $request->code)
            ->get();
    }

    public function getAllOrderBy($column, $ascOrDesc) {
        switch ($ascOrDesc) {
            default:
            case 'asc':
                return Shipment::select('shipments.*')
                    ->where('webshop', Auth::user()->webshop)
                    ->orderBy($column, 'asc')
                    ->paginate(8);
            case 'desc':
                return Shipment::select('shipments.*')
                    ->where('webshop', Auth::user()->webshop)
                    ->orderBy($column, 'desc')
                    ->paginate(8);
        }
    }
}

