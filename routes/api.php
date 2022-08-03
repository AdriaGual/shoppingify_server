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
Route::middleware(['cors'])->group(function () {
    Route::get('/categories/find_by_name', [CategoryController::class, 'find_by_name']);
    Route::get('/items/find_by_name', [ItemController::class, 'find_by_name']);
    Route::get('/lists/find_by_name', [ListaController::class, 'find_by_name']);

    Route::get('/lists/find_by_user_id', [ListaController::class, 'find_by_user_id']);

    Route::get('/lists/find_items/{id}', [ListaController::class, 'find_items']);

    Route::get('/categories/get_items', [CategoryController::class, 'get_items']);

    Route::put('/lists/update_list_items', [ListaController::class, 'update_list_items']);

    Route::post('/lists/set_active_list/{list_id}',[ListaController::class, 'set_active_list']);

    Route::post('/lists/add_item_to_list/{item_id}/{list_id}',[ListaController::class, 'add_item_to_list']);

    Route::resource('items',ItemController::class);

    Route::resource('categories',CategoryController::class);

    Route::resource('lists',ListaController::class);

});



