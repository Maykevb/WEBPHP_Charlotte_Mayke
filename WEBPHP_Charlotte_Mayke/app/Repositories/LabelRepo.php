<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Label;

class LabelRepo implements CrudInterface
{
    public function getAll()
    {
        return Label::all();
    }

    public function find($id)
    {
        return Label::find($id);
    }

    public function checkIfExist($trackAndTrace)
    {
        return Label::select()->where('trackAndTrace', $trackAndTrace);
    }

    public function delete($id)
    {
        Label::find($id)->delete();
    }

    public function create($data)
    {
        return Label::create($data);
    }

    public function update($data, $id)
    {
        $label = Label::where('id', $id)->first();
//        TODO
//        $label->city = $data['city'];
//        $label->province = $data['province'];
//        $label->continent = $data['continent'];
//        $label->coordinate_y = $data['coordinate_y'];
//        $label->coordinate_x = $data['coordinate_x'];
        $label->save();
    }
}

