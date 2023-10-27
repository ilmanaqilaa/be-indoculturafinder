<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('buku', [BookController::class, 'index']);
// Route::get('buku/{id}', [BookController::class, 'show']);
// Route::post('buku', [BookController::class, 'store']);
// Route::put('buku/{id}', [BookController::class, 'update']);
// Route::delete('buku/{id}', [BookController::class, 'destroy']);

Route::apiResource('buku', BookController::class);