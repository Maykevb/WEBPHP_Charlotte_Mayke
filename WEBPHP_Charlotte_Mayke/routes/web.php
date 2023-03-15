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

Route::get('/trackAndTrace', function() {
    return view('/trackAndTrace', [
        'listPackages' => (new App\Http\Controllers\PackageController)->getAllPackages()
    ]);
})->name('trackAndTrace');

Route::get('/trackAndTrace/{id}/{company}',[\App\Http\Controllers\PackageController::class, 'createLabelForPackage'])
    ->name('makeLabel');

Route::get('/trackAndTrace/{company}',[\App\Http\Controllers\PackageController::class, 'createBulkLabels'])
    ->name('bulkLabel');


