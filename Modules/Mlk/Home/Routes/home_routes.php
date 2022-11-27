<?php

use Illuminate\Support\Facades\Route;
use Mlk\Home\Http\Controllers\HomeController;


Route::group([], function ($router) {
    $router->get('/', ['uses'=>'HomeController@index','as'=>'home.index'])->middleware(['auth', 'verified']);
});
