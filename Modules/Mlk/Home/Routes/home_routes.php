<?php

use Illuminate\Support\Facades\Route;
use Mlk\Home\Http\Controllers\HomeController;

 Route::get('/', [HomeController::class , 'index']);


// Route::group([], function () {
//     # I. In: Route:foo - Use Snipptes Everything Know About Routes
//     Route::get('/foo', function () {
//         return view('welcome');
//     });
// });
