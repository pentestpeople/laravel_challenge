<?php

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::namespace('API')->group(function () {
    Route::post('register', 'RegistrationController@register');
    Route::post('login', 'LoginController@login');

    Route::middleware(['auth:api'])->group(function() {

        Route::prefix('tickets')->group(function () {
            Route::get('open', 'TicketsController@openTickets');
            Route::get('closed', 'TicketsController@closedTickets');
        });

        Route::prefix('users')->group(function () {
            Route::get('{email}/tickets', 'UsersController@userTickets');
        });

        Route::get('stats', 'StatsController@index');
        
        Route::post('logout', 'LoginController@logout');
    });
});