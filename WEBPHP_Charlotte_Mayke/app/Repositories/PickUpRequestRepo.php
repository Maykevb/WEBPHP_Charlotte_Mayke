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
        $pickUpRequest->id = $data['id'];
        $pickUpRequest->save();
    }
}

