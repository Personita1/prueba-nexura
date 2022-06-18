<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RolesController;

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

Route::get('/listado', [EmpleadoController::class, 'index']);

Route::get('/crear', [EmpleadoController::class, 'create']);

Route::post('/guardar',[EmpleadoController::class,'store']);

Route::post('/eliminar/{id}',[EmpleadoController::class,'destroy']);

Route::get('/editar/{id}',[EmpleadoController::class,'edit']);

Route::post('/actualizar/{id}',[EmpleadoController::class,'update']);

