<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RentalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('page.beranda');
});

Route::get('/beranda', function () {
    return view('page.beranda');
});

Route::get('/about', function () {
    return view('page.about');
});

Route::resource('/mobil',MobilController::class)->middleware('auth');
Route::resource('/pelanggan',PelangganController::class)->middleware('auth');
Route::resource('/rental',RentalController::class)->middleware('auth');
Route::get('mobilpdf',[MobilController::class,'PDF'])->middleware('auth');
Route::get('pelangganpdf',[PelangganController::class,'PDF'])->middleware('auth');
Route::get('rentalpdf',[RentalController::class,'PDF'])->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/afterRegister', function () {
    return view('page.afterRegister');
});