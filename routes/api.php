<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IPAddressController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // ...
    // public routes
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::get('ipaddress/addresses', [IPAddressController::class, 'getAll']);
    // ...

    Route::middleware('auth:api')->group(function () {

        // our routes to be protected will go in here

        Route::post('logout', [LoginController::class, 'logout']);

        // ip address route group with prefix 
        Route::group(['prefix' => 'ipaddress'], function () {
            Route::post('create', [IPAddressController::class, 'create']);
            Route::put('update/{id}', [IPAddressController::class, 'update']);
            Route::get('audit-trails/{id}', [IPAddressController::class, 'ipAuditTrails']);
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('activities', [UserController::class, 'userActvityLogs']);
            Route::get('audit-trails', [UserController::class, 'userAuditTrails']);
        });
    });
});
