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
//        $company->city = $data['city'];
//        $company->province = $data['province'];
//        $company->continent = $data['continent'];
//        $company->coordinate_y = $data['coordinate_y'];
//        $company->coordinate_x = $data['coordinate_x'];
        $company->save();
    }
}

