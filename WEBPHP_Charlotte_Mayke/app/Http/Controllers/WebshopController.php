<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebshopController extends Controller
{
    public function createWebshop(Request $request)
    {
        $this->createAccountWithRole($request, 3);
        return view('home');
    }

    public function createAdministrativeEmployee(Request $request)
    {
        $this->createAccountWithRole($request, 4);
        return view('home');
    }

    public function createPackerEmployee(Request $request)
    {
        $this->createAccountWithRole($request, 5);
        return view('home');
    }

    public function createAccountWithRole(Request $request, int $role_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ],
            ['name.required' => 'Het is verplicht een username in te vullen',
                'email.required' => 'Het is verplicht een email in te vullen',
                'email.unique' => 'Er bestaat al een account met deze email',
                'password.required' => 'Het is verplicht een wachtwoord in te vullen',
                'password.confirmed' => 'De wachtwoord bevestiging komt niet overeen met het wachtwoord',
                'password_confirmation.required' => 'Het is verplicht een wachtwoord bevesting in te vullen'
            ]);

        $user = new user();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $role_id;
        if($role_id == 3)
        {
            $user->remember_token = $this->generateToken();
        }
        $user->save();
    }

    public function generateToken()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 10;

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (user::select()->where('remember_token', $code)->exists()) {
            $this->generateToken();
        }

        return $code;
    }
}


