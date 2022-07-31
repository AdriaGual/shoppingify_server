<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories/find_by_name', [CategoryController::class, 'find_by_name']);
Route::get('/items/find_by_name', [ItemController::class, 'find_by_name']);
Route::get('/lists/find_by_name', [ListaController::class, 'find_by_name']);

Route::post('/items/add_to_list',[ItemController::class, 'add_to_list']);

Route::resource('items',ItemController::class);

Route::resource('categories',CategoryController::class);

Route::resource('lists',ListaController::class);


