<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\TingkatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\Api\ChangeController;

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

    Route::resource('roles', RoleController::class)->except('show');
    Route::get('roles/ajax/datatable', [RoleController::class, 'datatable'])->name('roles.ajax.datatable');

    Route::resource('users', UserController::class)->except('show');
    Route::get('users/ajax/datatable', [UserController::class, 'datatable'])->name('users.ajax.datatable');

    Route::resource('absensis', AbsensiController::class)->only('index');
    Route::get('absensis/ajax/datatable', [AbsensiController::class, 'datatable'])->name('absensis.ajax.datatable');

    Route::get('reports/date', [ReportController::class, 'reportDate'])->name('reports.date');
    Route::get('reports/date/ajax/datatable', [ReportController::class, 'reportDateDatatable'])->name('reports.date.ajax.datatable');
    Route::get('reports/date/export', [ReportController::class, 'reportDateExport'])->name('reports.date.export');

    Route::get('reports/siswa', [ReportController::class, 'reportSiswa'])->name('reports.siswa');
    Route::get('reports/siswa/ajax/datatable', [ReportController::class, 'SiswaDatatable'])->name('reports.siswa.ajax.datatable');
    Route::get('reports/siswa/{id}/absensis', [ReportController::class, 'AbsensiSiswa'])->name('reports.siswa.absensi');
    Route::get('reports/siswa/{id}/absensis/ajax/datatable', [ReportController::class, 'absensiSiswaDatatable'])->name('reports.siswa.absensis.ajax.datatable');
    Route::get('reports/siswa/{id}/absensis/export', [ReportController::class, 'reportSiswaExport'])->name('reports.siswa.export');

    Route::resource('pengaturans', PengaturanController::class)->only(['index', 'store']);
});

