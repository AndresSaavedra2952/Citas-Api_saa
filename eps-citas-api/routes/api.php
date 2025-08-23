<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\EpsController;
use App\Http\Controllers\ConsultorioController;

// PACIENTES
Route::get('/pacientes', [PacienteController::class, 'index']);//°
Route::post('/pacientes', [PacienteController::class, 'store']);//°
Route::get('/pacientes/{id}', [PacienteController::class, 'show']);//°
Route::put('/pacientes/{id}', [PacienteController::class, 'update']);//°
Route::delete('/pacientes/{id}', [PacienteController::class, 'destroy']);//°

// ESPECIALIDADES
Route::get('/especialidades', [EspecialidadController::class, 'index']);//°
Route::post('/especialidades', [EspecialidadController::class, 'store']);   //° 
Route::get('/especialidades/{id}', [EspecialidadController::class, 'show']); //° 
Route::put('/especialidades/{id}', [EspecialidadController::class, 'update']);//° 
Route::delete('/especialidades/{id}', [EspecialidadController::class, 'destroy']);//° 

// MÉDICOS
Route::get('/medicos', [MedicoController::class, 'index']);
Route::post('/medicos', [MedicoController::class, 'store']);
Route::get('/medicos/{id}', [MedicoController::class, 'show']);
Route::put('/medicos/{id}', [MedicoController::class, 'update']);
Route::delete('/medicos/{id}', [MedicoController::class, 'destroy']);

// CITAS
Route::get('/citas', [CitaController::class, 'index']);
Route::post('/citas', [CitaController::class, 'store']);
Route::get('/citas/{id}', [CitaController::class, 'show']);
Route::put('/citas/{id}', [CitaController::class, 'update']);
Route::delete('/citas/{id}', [CitaController::class, 'destroy']);

// EPS
Route::get('/eps', [EpsController::class, 'index']);
Route::post('/eps', [EpsController::class, 'store']);
Route::get('/eps/{id}', [EpsController::class, 'show']);
Route::put('/eps/{id}', [EpsController::class, 'update']);
Route::delete('/eps/{id}', [EpsController::class, 'destroy']);

// CONSULTORIOS
Route::get('/consultorios', [ConsultorioController::class, 'index']);
Route::post('/consultorios', [ConsultorioController::class, 'store']);
Route::get('/consultorios/{id}', [ConsultorioController::class, 'show']);
Route::put('/consultorios/{id}', [ConsultorioController::class, 'update']);
Route::delete('/consultorios/{id}', [ConsultorioController::class, 'destroy']);
