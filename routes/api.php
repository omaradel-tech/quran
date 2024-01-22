<?php

use App\Http\Controllers\Apis\AuthController;
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

Route::group([
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers\Apis'
    ], function()
    {
        Route::post('/auth/login', 'AuthController@login');
        Route::post('/auth/register', 'AuthController@register');

        Route::group([ 'middleware' => ['auth:sanctum'] ] ,function(){
            Route::get('test' , function (){
                return 123;
            });
        });
    }
);
