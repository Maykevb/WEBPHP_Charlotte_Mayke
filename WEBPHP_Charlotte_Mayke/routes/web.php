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

Route::get('/pickUpRequest', function()
{
    return view('/pickUpRequest', [
        'listPackages' => (new App\Http\Controllers\PackageController)->getAllPackages()
    ]);
})->name('startRequest');



