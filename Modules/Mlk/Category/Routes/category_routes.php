<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], static function ($router) {
    $router->patch('categories/{id}/status', 'CategoryController@changeStatus')->name('categories.change.status'); # Update - Change Status  
    $router->resource('categories', 'CategoryController', ['except' => 'show']); # CRUD Routes For Category
});


