<?php

namespace App\Http\Controllers;

use App\Repositories\PickUpRequestRepo;
use Illuminate\Http\Request;
use App\Models\PickUpRequest;
use Illuminate\Support\Facades\Auth;

class FullCalenderController extends Controller
{
    private PickUpRequestRepo $pickRepo;

    public function __construct()
    {
        $this->pickRepo = new PickUpRequestRepo();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->pickRepo->fullCalender($request);
            return response()->json($data);
        }

        return view('fullcalender');
    }
}
