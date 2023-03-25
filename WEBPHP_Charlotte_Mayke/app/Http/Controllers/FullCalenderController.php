<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickUpRequest;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()) {

            $data = PickUpRequest::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('fullcalender');
    }
}
