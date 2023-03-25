<?php

use App\Http\Controllers\FullCalenderController;
use App\Models\Shipment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/trackAndTrace', function () {
//    return view('trackAndTrace');
//})->name('trackAndTrace');

//Route::get('/labelList', function() {
//    return view('/labelList', [
//        'listPackages' => (new App\Http\Controllers\PackageController)->getAllPackages()
//    ]);
//})->name('labelList');

Route::get('/labelList', [\App\Http\Controllers\PackageController::class, 'getAllPackages'])->name('labelList');

Route::post('pickup-form', [\App\Http\Controllers\PackageController::class, 'createPickUpForShipment'])
    ->name('pickup');

Route::get('/pickUpRequest/{shipment}', function(Shipment $shipment) {
    return view('/pickUpRequest', [
        'shipment' => $shipment
    ]);
})->name('startRequest');

Route::post('label-form', [\App\Http\Controllers\PackageController::class, 'handleLabels'])
->name('list');

Route::get('/shipmentRegistration', function() {
    return view('/shipmentRegistration', [
        'shipments'  => (new \App\Http\Controllers\ShipmentController)->getAllShipments()
    ]);
})->name('registerShipments');

Route::get('/uploadFile', [\App\Http\Controllers\UploadFileController::class,'createForm'])
->name('importcsv');

Route::post('/uploadFile', [\App\Http\Controllers\UploadFileController::class,'fileUpload'])
->name('fileUpload');

Route::get('/myShipments', [\App\Http\Controllers\ShipmentController::class,'shipments'])
    ->name('myShipments');

Route::post('/myShipments', [\App\Http\Controllers\ShipmentController::class,'getShipmentWithTandTCode'])
    ->name('myShipmentsGet');

Route::get('/writeReview', [\App\Http\Controllers\ShipmentController::class,'findShipment'])
    ->name('writeReview');

Route::post('/writeReview', [\App\Http\Controllers\ShipmentController::class,'insertReview'])
    ->name('writtenReview');

Route::get('/fullcalender', [FullCalenderController::class, 'index'])->name('calender');


