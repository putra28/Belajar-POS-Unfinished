<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMemberController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\DataPenjualanController;
use App\Http\Controllers\DataProdukController;
use App\Http\Controllers\DataSupplierController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;

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
    return view('Login');
});

Route::post('/proc_login', [LoginController::class, 'proc_Login']);

Route::get('/dashboard', [DashboardController::class, 'Index'])->name('Dashboard');
Route::get('/transaksi', [TransaksiController::class, 'Index'])->name('Transaksi');
