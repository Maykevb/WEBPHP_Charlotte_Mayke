<?php

namespace App\Http\Controllers;

use App\Repositories\ShipmentRepo;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        //TODO: add di
    }

    public function getAllPackages()
    {
        $repo = new ShipmentRepo();
        return $repo->getAll();
    }



}
