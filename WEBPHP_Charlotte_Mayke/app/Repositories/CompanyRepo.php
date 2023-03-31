<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Company;

class CompanyRepo implements CrudInterface
{
    public function getAll()
    {
        return Company::all();
    }

    public function find($id)
    {
        return Company::find($id);
    }

    public function findWhere($name)
    {
        return Company::select()->where('naam', $name)->pluck('id');
    }

    public function delete($id)
    {
        Company::find($id)->delete();
    }

    public function create($data)
    {
        return Company::create($data);
    }

    public function update($data, $id)
    {
        $company = Company::where('id', $id)->first();
        $company->id = $data['id'];
        $company->save();
    }
}

