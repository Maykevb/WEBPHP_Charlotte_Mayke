<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\PickUpRequest;
use Illuminate\Support\Facades\Auth;

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

    public function fullCalender($request) {
        return PickUpRequest::whereDate('start', '>=', $request->start)
            ->where('webshop', Auth::user()->webshop)
            ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title', 'start', 'end']);
    }
}

