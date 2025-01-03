<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TingkatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('jurusan', JurusanController::class);
Route::apiResource('tingkat', TingkatController::class);
Route::apiResource('siswa', SiswaController::class);
Route::apiResource('device', DeviceController::class);
