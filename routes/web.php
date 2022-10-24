<?php

use App\Http\Controllers\Auth\AuthController;
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
})->middleware('auth');

Route::get('/home', function() {
    return redirect('/');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.action');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/barang', function () {
    $data['suppliers'] = Supplier::latest()->get();
    return view('barang', $data);
})->middleware('auth');


Route::resource('barang-ajax', BarangController::class)->middleware('auth');
