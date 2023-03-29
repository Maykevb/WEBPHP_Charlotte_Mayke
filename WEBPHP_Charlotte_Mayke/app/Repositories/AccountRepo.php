<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use App\Models\user;

class AccountRepo implements CrudInterface
{
    public function getAll()
    {
        return user::all();
    }

    public function find($id)
    {
        return user::find($id);
    }

    public function findByTokenAndEmail($token, $email)
    {
        return user::select()
            ->where('remember_token', '=', $token)
            ->where('email', '=', $email)
            ->get();
    }


    public function delete($id)
    {
        user::find($id)->delete();
    }

    public function create($data)
    {
        return user::create($data);
    }

    public function update($data, $id)
    {
        $account = user::where('id', $id)->first();
//        TODO
//        $account->city = $data['city'];
//        $account->province = $data['province'];
//        $account->continent = $data['continent'];
//        $account->coordinate_y = $data['coordinate_y'];
//        $account->coordinate_x = $data['coordinate_x'];
        $account->save();
    }
}

