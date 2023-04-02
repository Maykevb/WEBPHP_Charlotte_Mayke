<?php

use App\Http\Controllers\FullCalenderController;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::middleware(['auth', 'role_trackruser'])->get('/labelList',
    [\App\Http\Controllers\LabelController::class, 'getAllPackages'])
    ->name('labelList');

Route::middleware(['auth', 'role_trackruser'])->post('pickup-form',
    [\App\Http\Controllers\LabelController::class, 'createPickUpForShipment'])
    ->name('pickup');

Route::middleware(['auth', 'role_trackruser'])->post('/pickUpRequest/{shipment}', function(Shipment $shipment) {
    return view('/pickUpRequest', [
        'shipment' => $shipment
    ]);
})->name('startRequest');

Route::middleware(['auth', 'role_trackruser'])->post('label-form',
    [\App\Http\Controllers\LabelController::class, 'handleLabels'])
    ->name('list');

Route::middleware(['auth', 'role_trackruser'])->get('label-form', function() {
    return view('/pickUpRequest', [
        'list'  => Session::get('list')
    ]);
}) ->name('label-form');

Route::middleware(['auth', 'rights_signup'])->get('/shipmentRegistration', function() {
    return view('/shipmentRegistration', [
        'shipments'  => (new \App\Http\Controllers\ShipmentController)->getAllShipments()
    ]);
})->name('registerShipments');

Route::middleware(['auth', 'rights_signup'])->get('/uploadFile', [\App\Http\Controllers\UploadFileController::class,'createForm'])
    ->name('importcsv');

Route::middleware(['auth', 'rights_signup'])->post('/uploadFile', [\App\Http\Controllers\UploadFileController::class,'fileUpload'])
    ->name('fileUpload');

Route::middleware(['auth', 'role_ontvanger'])->get('/myShipments',
    [\App\Http\Controllers\ShipmentController::class,'shipments'])
    ->name('myShipments');

Route::middleware(['auth', 'role_ontvanger'])->post('/myShipments',
    [\App\Http\Controllers\ShipmentController::class,'getShipmentWithTandTCode'])
    ->name('myShipmentsGet');

Route::middleware(['auth', 'role_ontvanger'])->get('/writeReview',
    [\App\Http\Controllers\ShipmentController::class,'findShipment'])
    ->name('writeReview');

Route::middleware(['auth', 'role_ontvanger'])->post('/writeReview',
    [\App\Http\Controllers\ShipmentController::class,'insertReview'])
    ->name('writtenReview');

Route::middleware(['auth', 'role_admin'])->get('/registerTrackR', function() {
    return view('/registerTrackR');
})->name('webshops');

Route::middleware(['auth', 'role_admin'])->post('/registerTrackR',
    [\App\Http\Controllers\WebshopController::class, 'createWebshop'])
    ->name('createWebshop');

Route::middleware(['auth', 'role_ontvanger'])->get('reviews',
    [\App\Http\Controllers\ShipmentController::class, 'getAllReviews'])->name('reviewsOverview');

Route::middleware(['auth', 'role_trackruser'])->get('/fullcalender', [FullCalenderController::class, 'index'])
    ->name('calender');

Route::get('lang/{lang}', [\App\Http\Controllers\LanguageController::class, 'switchLang'])->name('switch');

Route::middleware(['auth', 'role_trackruser'])->get('/registerAdministrativeEmployee', function() {
    return view('/registerAdministrativeEmployee');
})->name('administrative');

Route::middleware(['auth', 'role_trackruser'])->post('/registerAdministrativeEmployee',
    [\App\Http\Controllers\WebshopController::class, 'createAdministrativeEmployee'])
    ->name('createAdministrative');

Route::middleware(['auth', 'role_trackruser'])->get('/registerPackerEmployee', function() {
    return view('/registerPackerEmployee');
})->name('packer');

Route::middleware(['auth', 'role_trackruser'])->post('/registerPackerEmployee',
    [\App\Http\Controllers\WebshopController::class, 'createPackerEmployee'])
    ->name('createPacker');
