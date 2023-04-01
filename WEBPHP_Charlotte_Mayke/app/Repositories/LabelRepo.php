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
        $label->id = $data['id'];
        $label->save();
    }
}

