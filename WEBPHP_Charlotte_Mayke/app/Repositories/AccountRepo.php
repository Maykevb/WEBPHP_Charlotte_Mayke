<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\Account;

class AccountRepo implements CrudInterface
{
    public function getAll()
    {
        return Account::all();
    }

    public function find($id)
    {
        return Account::find($id);
    }

    public function delete($id)
    {
        Account::find($id)->delete();
    }

    public function create($data)
    {
        return Account::create($data);
    }

    public function update($data, $id)
    {
        $account = Account::where('id', $id)->first();
//        TODO
//        $account->city = $data['city'];
//        $account->province = $data['province'];
//        $account->continent = $data['continent'];
//        $account->coordinate_y = $data['coordinate_y'];
//        $account->coordinate_x = $data['coordinate_x'];
        $account->save();
    }
}

