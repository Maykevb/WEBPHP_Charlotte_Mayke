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
        return Shipment::select('shipments.*')
            ->where('webshop', Auth::user()->webshop)
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }

    public function getAllOrderByHasLabel($column, $ascOrDesc) {
        return Shipment::select('shipments.*')
            ->where('webshop', Auth::user()->webshop)
            ->whereNotNull('label_id')
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }

    public function getAllOrderByNoLabel($column, $ascOrDesc) {
        return Shipment::select('shipments.*')
            ->where('webshop', Auth::user()->webshop)
            ->where('label_id', null)
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }

    public function getAllOrderByHasPickup($column, $ascOrDesc) {
        return Shipment::select('shipments.*')
            ->where('webshop', Auth::user()->webshop)
            ->whereNotNull('pickUpRequest_id')
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }

    public function getAllOrderByNoPickup($column, $ascOrDesc) {
        return Shipment::select('shipments.*')
            ->where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', null)
            ->orderBy($column, $ascOrDesc)
            ->paginate(8);
    }
}

