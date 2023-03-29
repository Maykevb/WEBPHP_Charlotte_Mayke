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

Route::get('/{token}/{email}/{name}/{street}/{nr}/{code}/{place}',
    function (string $token, string $email, string $name, string $street, string $nr, string $code, string $place) {
        return ['shipment' => (new App\Http\Controllers\ShipmentController())
            ->signUpShipment($token, $email, $name, $street, $nr, $code, $place)];
    });

Route::get('/{token}/{email}/{id}/{status}',
    function (string $token, string $email, int $id, string $status) {
        return ['shipment' => (new App\Http\Controllers\ShipmentController())
            ->updateShipmentStatus($token, $email, $id, $status)];
    });

