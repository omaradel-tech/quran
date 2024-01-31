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
            Route::get('profile', 'AuthController@profile');
            Route::post('profile', 'AuthController@updateProfile');
            Route::get('editions', 'QuranController@getAllEditions');
            Route::get('editions/{edition}', 'QuranController@getEditionSurahWithAyahs');
            Route::get('surahs', 'QuranController@getAllsurahs');
            Route::get('surahs/{surah}', 'QuranController@getSurahWithAyahs');
            Route::get('search', 'QuranController@searchInAyahs');
        });
    }
);
