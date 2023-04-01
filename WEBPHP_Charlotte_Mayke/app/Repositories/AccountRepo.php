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
            ->where('role_id', '=', 3)
            ->get()
            ->first();
    }

    public function findByTokenAndEmailCompany($token, $email)
    {
        return user::select()
            ->where('remember_token', '=', $token)
            ->where('email', '=', $email)
            ->where('role_id', '=', 6)
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
        $account->save();
    }
}

