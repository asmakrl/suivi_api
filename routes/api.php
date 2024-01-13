<?php

use App\Http\Controllers\RequestsController;
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
//requests
Route::get('requests', [RequestsController::class, 'index']);
Route::post('requests', [RequestsController::class, 'store']);
Route::get('requests/{id}', [RequestsController::class, 'show']);
Route::put('requests/{id}', [RequestsController::class, 'update']);
Route::delete('requests/{id}', [RequestsController::class, 'destroy']);

//senders
Route::get('senders', [RequestsController::class, 'index']);
Route::post('senders', [RequestsController::class, 'store']);
Route::get('senders/{id}', [RequestsController::class, 'show']);
Route::put('senders/{id}', [RequestsController::class, 'update']);
Route::delete('senders/{id}', [RequestsController::class, 'destroy']);

//types
Route::get('types', [RequestsController::class, 'index']);
Route::post('types', [RequestsController::class, 'store']);
Route::get('types/{id}', [RequestsController::class, 'show']);
Route::put('types/{id}', [RequestsController::class, 'update']);
Route::delete('types/{id}', [RequestsController::class, 'destroy']);

//actions
Route::get('actions', [RequestsController::class, 'index']);
Route::post('actions', [RequestsController::class, 'store']);
Route::get('actions/{id}', [RequestsController::class, 'show']);
Route::put('actions/{id}', [RequestsController::class, 'update']);
Route::delete('actions/{id}', [RequestsController::class, 'destroy']);

//files
Route::get('files', [RequestsController::class, 'index']);
Route::post('files', [RequestsController::class, 'store']);
Route::get('files/{id}', [RequestsController::class, 'show']);
Route::put('files/{id}', [RequestsController::class, 'update']);
Route::delete('file/{id}', [RequestsController::class, 'destroy']);
