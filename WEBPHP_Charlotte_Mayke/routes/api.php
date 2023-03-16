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

//TODO: secure the API call -> only webshop, get rid of 'test' in route
Route::get('/test/{street}/{nr}/{code}/{place}', function (string $street, int $nr, string $code, string $place) {
    return['shipment' => (new App\Http\Controllers\ShipmentController())
                      ->signUpShipment($street, $nr, $code, $place)];
});

//TODO: secure the API call -> only shipment company, get rid of 'test' in route
Route::get('/test/{id}/{status}', function (int $id, string $status) {
    return['shipment' => (new App\Http\Controllers\ShipmentController())
                      ->updateShipmentStatus($id, $status)];
});

//TODO: needed?
//Route::get('/test/{street}/{nr}/{code}', function (string $street, int $nr, string $code) {
//    return new ShipmentResource();
//});
//
//Route::get('/shipment/{id}', function (string $id) {
//    return new ShipmentResource(Shipment::findOrFail($id));
//});
//
//Route::get('/shipments', function () {
//    return new ShipmentResourceCollection(Shipment::all());
//});
