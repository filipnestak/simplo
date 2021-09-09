<?php

use App\Http\Controllers\Api\{
    AuthController,
    CustomerController
};
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers/{id}/{withGroups?}', [CustomerController::class, 'show']);
    Route::post('customers', [CustomerController::class, 'store']);
    Route::put('customers/{id}', [CustomerController::class, 'update']);
    Route::delete('customers/{id}', [CustomerController::class, 'delete']);

    Route::put('customers/{id}/add-customer-group', [CustomerController::class, 'addCustomerGroup']);
    Route::put('customers/{id}/remove-customer-group', [CustomerController::class, 'removeCustomerGroup']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
