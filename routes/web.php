<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});
Route::post('/payment', [PaymentController::class,'index'])->name('payment');
Route::resource('users', UserController::class);
Route::get('tambah-saldo/{id}', [UserController::class, 'tambah_saldo'])->name('users.saldo');
Route::post('update-saldo/{id}', [UserController::class, 'update_saldo'])->name('users.update_saldo');