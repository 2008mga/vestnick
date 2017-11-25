<?php

use Illuminate\Http\Request;

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
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('me', 'Api\MeController@me');
});

Route::get('/tag/{id}', 'Api\TagsController@find');
Route::get('/tags/inline', 'Api\TagsController@inline');
Route::get('/tags', 'Api\TagsController@index');

Route::get('/news', 'Api\NewsController@index');
Route::get('/news/by/tag/{id}', 'Api\NewsController@byTag');
Route::get('/news/by/user/{id}', 'Api\NewsController@byUser');
Route::get('/user/{id}', 'Api\UsersController@anket');
