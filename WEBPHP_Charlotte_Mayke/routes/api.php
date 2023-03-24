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

//TODO: secure the API call -> only webshop
Route::get('/{username}/{password}/{name}/{street}/{nr}/{code}/{place}',
    function (string $username, string $password, string $name, string $street, string $nr, string $code, string $place) {
    return['shipment' => (new App\Http\Controllers\ShipmentController())
                      ->signUpShipment($username, $password, $name, $street, $nr, $code, $place)];
});

//TODO: secure the API call -> only shipment company
Route::get('/{username}/{password}/{id}/{status}',
    function (string $username, string $password, int $id, string $status) {
    return['shipment' => (new App\Http\Controllers\ShipmentController())
                      ->updateShipmentStatus($username, $password, $id, $status)];
});
