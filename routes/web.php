<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TingkatController;
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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/',DashboardController::class)->name('home');

    Route::resource('jurusans', JurusanController::class)->except('show');
    Route::get('jurusans/ajax/datatable', [JurusanController::class, 'datatable'])->name('jurusans.ajax.datatable');

    Route::resource('tingkats', TingkatController::class)->except('show');
    Route::get('tingkats/ajax/datatable', [TingkatController::class, 'datatable'])->name('tingkats.ajax.datatable');

    Route::resource('kartus', KartuController::class)->only(['index', 'destroy']);
    Route::get('kartus/ajax/datatable', [KartuController::class, 'datatable'])->name('kartus.ajax.datatable');

    Route::resource('siswa', SiswaController::class);
    Route::get('siswa/ajax/datatable', [SiswaController::class, 'datatable'])->name('siswa.ajax.datatable');

    Route::resource('devices', DeviceController::class)->except('show');
    Route::get('devices/ajax/datatable', [DeviceController::class, 'datatable'])->name('devices.ajax.datatable');
});
