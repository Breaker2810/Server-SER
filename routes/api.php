<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\BlogController;
use App\Models\Multimedia;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//RUTAS

// Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios/add', [UsuarioController::class, 'store']);
Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);

// Blog
Route::get('/blogs', [BlogController::class, 'index']);
Route::post('/blogs/add', [BlogController::class, 'store']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::put('/blogs/{id}', [BlogController::class, 'update']);
Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);

// Multimedia
Route::get('/recursos', [MultimediaController::class, 'index']);
Route::post('/recursos/add', [MultimediaController::class, 'store']);
Route::get('/recursos/{id}', [MultimediaController::class, 'show']);
Route::put('/recursos/{id}', [MultimediaController::class, 'update']);
Route::delete('/recursos/{id}', [MultimediaController::class, 'destroy']);


