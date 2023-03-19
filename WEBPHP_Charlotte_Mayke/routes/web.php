<?php

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

Route::get('/labelList', function() {
    return view('/labelList', [
        'listPackages' => (new App\Http\Controllers\PackageController)->getAllPackages()
    ]);
})->name('labelList');

Route::get('/labelList/{id}/{company}',[\App\Http\Controllers\PackageController::class, 'createLabelForPackage'])
    ->name('makeLabel');

Route::get('/labelList/{company}',[\App\Http\Controllers\PackageController::class, 'createBulkLabels'])
    ->name('bulkLabel');

Route::get('/pickUpRequest', function() {
    return view('/pickUpRequest', [
        'listPackages' => (new App\Http\Controllers\PackageController)->getAllPackages()
    ]);
})->name('startRequest');

Route::post('label-form', [\App\Http\Controllers\PackageController::class, 'handleLabels'])
->name('list');

Route::get('/shipmentRegistration', function() {
    return view('/shipmentRegistration', [
        'shipments'  => (new \App\Http\Controllers\ShipmentController)->getAllShipments()
    ]);
})->name('registerShipments');

//Route::get('/shipmentRegistration/csvImport', [\App\Http\Controllers\ShipmentController::class,'importCsv'])
//->name('importcsv');

Route::get('/uploadFile', [\App\Http\Controllers\UploadFileController::class,'createForm'])
->name('importcsv');

Route::post('/uploadFile', [\App\Http\Controllers\UploadFileController::class,'fileUpload'])
->name('fileUpload');

//Route::get('user-delete/{id}',[UserController::class,'delete'])->name('user.delete');


