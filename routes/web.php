<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\TechnicienController;

Route::resource('vehicules', VehiculeController::class);
Route::resource('reparations', ReparationController::class);
Route::resource('techniciens', TechnicienController::class);

Route::get('/', function () {
    return redirect()->route('vehicules.index');
});

Route::get('/', function () {
    return view('welcome');
});
