<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ResponsesController;
use App\Http\Controllers\SendersController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\FileUploadController;
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
Route::get('requests/{request_id}/statuses/{status_id}', [RequestsController::class, 'add']);
//Route::get('requests/{id}', [RequestsController::class, 'show']);
Route::get('requests/{id}', [RequestsController::class, 'showFile']);

Route::put('requests/{id}', [RequestsController::class, 'update']);
Route::put('requests/{request_id}/statuses/{status_id}/{status_id2}', [RequestsController::class, 'update_relation']);
Route::delete('requests/{id}', [RequestsController::class, 'destroy']);
Route::delete('requests/{request_id}/statuses/{status_id}', [RequestsController::class, 'delete_relation']);
Route::get('requests/search/{key}', [RequestsController::class, 'search']);

//senders
Route::get('senders', [SendersController::class, 'index']);
Route::get('senders/{category_id}', [SendersController::class, 'sendersByCategory']);
Route::get('senders/category/{categoryId}/state/{stateId?}', [SendersController::class, 'sendersByCategoryAndState']);

Route::post('senders', [SendersController::class, 'store']);
Route::get('senders/{id}', [SendersController::class, 'show']);
Route::put('senders/{id}', [SendersController::class, 'update']);
Route::delete('senders/{id}', [SendersController::class, 'destroy']);

//types
Route::get('types', [TypesController::class, 'index']);
Route::post('types', [TypesController::class, 'store']);
Route::get('types/{id}', [TypesController::class, 'show']);
Route::put('types/{id}', [TypesController::class, 'update']);
Route::delete('types/{id}', [TypesController::class, 'destroy']);

//actions
Route::get('actions', [ActionsController::class, 'index']);
Route::post('actions', [ActionsController::class, 'store']);
Route::get('actions/{id}', [ActionsController::class, 'show']);
Route::put('actions/{id}', [ActionsController::class, 'update']);
Route::delete('actions/{id}', [ActionsController::class, 'destroy']);

//files
Route::get('files', [FilesController::class, 'index']);
Route::post('files/{requestId}', [FilesController::class, 'store']);
Route::get('/files/{fileId}/download', [FilesController::class, 'download'])->name('files.download');

Route::get('files/{id}/{param}', [FilesController::class, 'show']);
Route::put('files/{id}', [FilesController::class, 'update']);
Route::delete('files/{file}', [FilesController::class, 'destroy']);

//states
Route::get('states', [StatesController::class, 'index']);
Route::post('states', [StatesController::class, 'store']);
Route::get('states/{id}', [StatesController::class, 'show']);
Route::put('states/{id}', [StatesController::class, 'update']);
Route::delete('states/{id}', [StatesController::class, 'destroy']);
Route::post('/upload', [FileUploadController::class, 'upload']);

//categories
Route::get('categories',[CategoriesController::class, 'index']);

//statuses
Route::get('statuses',[StatusesController::class, 'index']);
Route::get('statuses/{id}', [StatusesController::class, 'show']);

//responses
Route::get('responses',[ResponsesController::class, 'index']);
Route::get('responses/{id}', [ResponsesController::class, 'show']);
Route::post('responses', [ResponsesController::class, 'store']);
Route::put('responses/{id}', [ResponsesController::class, 'update']);
Route::delete('responses/{id}', [ResponsesController::class, 'destroy']);



