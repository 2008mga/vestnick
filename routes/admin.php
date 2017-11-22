<?php


Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::resource('users', 'UsersController', [
        'names' => [
            'create' => 'admin.users.create',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
            'index' => 'admin.users.index',
            'edit' => 'admin.users.edit',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show'
        ]
    ]);

    Route::resource('news', 'NewsController', [
        'names' => [
            'create' => 'admin.news.create',
            'update' => 'admin.news.update',
            'destroy' => 'admin.news.destroy',
            'index' => 'admin.news.index',
            'edit' => 'admin.news.edit',
            'store' => 'admin.news.store',
            'show' => 'admin.news.show'
        ]
    ]);

    Route::resource('tags', 'TagsController', [
        'names' => [
            'create' => 'admin.tags.create',
            'update' => 'admin.tags.update',
            'destroy' => 'admin.tags.destroy',
            'index' => 'admin.tags.index',
            'edit' => 'admin.tags.edit',
            'store' => 'admin.tags.store',
            'show' => 'admin.tags.show'
        ]
    ]);

    Route::post('upload/image', 'UploaderController@image');
});