<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\PickUpRequest;

class PickUpRequestRepo implements CrudInterface
{
    public function getAll()
    {
        return PickUpRequest::all();
    }

    public function find($id)
    {
        return PickUpRequest::find($id);
    }

    public function delete($id)
    {
        PickUpRequest::find($id)->delete();
    }

    public function create($data)
    {
        return PickUpRequest::create($data);
    }

    public function update($data, $id)
    {
        $pickUpRequest = PickUpRequest::where('id', $id)->first();
//        TODO
//        $pickUpRequest->city = $data['city'];
//        $pickUpRequest->province = $data['province'];
//        $pickUpRequest->continent = $data['continent'];
//        $pickUpRequest->coordinate_y = $data['coordinate_y'];
//        $pickUpRequest->coordinate_x = $data['coordinate_x'];
        $pickUpRequest->save();
    }
}

