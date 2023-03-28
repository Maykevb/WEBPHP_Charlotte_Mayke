<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebshopController extends Controller
{
    public function createWebshop(Request $request)
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
        $user->role_id = 2;
        $user->save();

        return view('home');
    }
}

