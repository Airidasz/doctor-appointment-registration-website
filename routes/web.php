<?php

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

Auth::routes();

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/doctor/{id}', [App\Http\Controllers\DoctorController::class, 'doctorProfile'])->name('doctor-profile');
Route::get('/doctor', [App\Http\Controllers\DoctorController::class, 'index']);


Route::post('/patient', [App\Http\Controllers\PatientController::class, 'newPatient'])->middleware('role:patient');
Route::post('/appointment', [App\Http\Controllers\AppointmentController::class, 'create'])->middleware('role:patient');;
Route::post('/appointment/delete', [App\Http\Controllers\AppointmentController::class, 'delete'])->middleware('role:patient');

Route::get('/new/doctor', [App\Http\Controllers\AdminController::class, 'index'])->middleware('role:admin');
Route::post('/user', [App\Http\Controllers\AdminController::class, 'createUser'])->middleware('role:admin');
Route::post('/doctor', [App\Http\Controllers\DoctorController::class, 'create'])->middleware('role:admin');

