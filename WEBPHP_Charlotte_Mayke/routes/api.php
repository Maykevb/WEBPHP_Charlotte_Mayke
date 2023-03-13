<?php

use App\Http\Resources\ShipmentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//TODO test
Route::get('/test/{street}/{nr}/{code}', function (string $street, int $nr, string $code) {
    return['shipment' => (new App\Http\Controllers\ShipmentController())
//                    ->signUpShipment($street, $nr, $code)
                      ->testing($street, $nr, $code)
    ];
});

//Route::get('/test/{street}/{nr}/{code}', function (string $street, int $nr, string $code) {
//    return new ShipmentResource();
//});

//TODO
//Route::get('/shipment/{id}', function (string $id) {
//    return new ShipmentResource(Shipment::findOrFail($id));
//});
//
//Route::get('/shipments', function () {
//    return new ShipmentResourceCollection(Shipment::all());
//});
