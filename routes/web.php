<?php

use App\Http\Controllers\BarangController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/barang', function () {
    $data['suppliers'] = Supplier::latest()->get();
    return view('barang', $data);
});


Route::resource('barang-ajax', BarangController::class);
