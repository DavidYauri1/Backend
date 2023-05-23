<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/clients',[ClienteController::class,'show_clients']);
Route::post('/clients/create',[ClienteController::class,'insert_client']);
Route::delete('/clients/{id}',[ClienteController::class,'delete_client']);
Route::put('clients/{id}', [ClienteController::class,'update_client'] );
Route::post('/clients/create/payment',[ClienteController::class,'insertClient']);
Route::get('/clients/{id}', [ClienteController::class,'get_client']);

