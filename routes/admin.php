<?php

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

Route::post('upload/image', 'UploaderController@image');