<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Review;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            ->where('label_id', '!=', null)
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
            ->where('pickUpRequest_id', '!=', null)
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

    public function hasLabelSearchAndSort($request, $temp) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('label_id', '!=', null)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function hasLabelAndSearch($request) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('label_id', '!=', null)
            ->paginate(8);
    }

    public function hasLabel() {
        return Shipment::where('webshop', Auth::user()->webshop)
            ->where('label_id', '!=', null)
            ->paginate(8);
    }

    public function noLabelSearchAndSort($request, $temp) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('label_id', null)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function noLabelAndSearch($request) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('label_id', null)
            ->paginate(8);
    }

    public function noLabel() {
        return Shipment::where('webshop', Auth::user()->webshop)
            ->where('label_id', null)
            ->paginate(8);
    }

    public function hasPickupSearchAndSort($request, $temp) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', '!=', null)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function hasPickupAndSearch($request) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', '!=', null)
            ->paginate(8);
    }

    public function hasPickup() {
        return Shipment::where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', '!=', null)
            ->paginate(8);
    }

    public function noPickupSearchAndSort($request, $temp) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', null)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function noPickupAndSearch($request) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', null)
            ->paginate(8);
    }

    public function noPickup() {
        return Shipment::where('webshop', Auth::user()->webshop)
            ->where('pickUpRequest_id', null)
            ->paginate(8);
    }

    public function allShipmentsSearchAndSort($request, $temp) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->orderBy($temp[0], $temp[1])
            ->paginate(8);
    }

    public function allShipmentsSearch($request) {
        return Shipment::search($request->search)
            ->where('webshop', Auth::user()->webshop)
            ->paginate(8);
    }

    public function allShipments() {
        return Shipment::where('webshop', Auth::user()->webshop)->paginate(8);
    }
}

