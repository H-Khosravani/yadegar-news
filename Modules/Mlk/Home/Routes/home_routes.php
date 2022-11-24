<?php

use Illuminate\Support\Facades\Route;
use Mlk\Home\Http\Controllers\HomeController;

 Route::get('/', [HomeController::class , 'index'])->name('home.index')->middleware(['auth', 'verified']);


// Route::group([], function () {
//     # I. In: Route:foo - Use Snipptes Everything Know About Routes
//     Route::get('/foo', function () {
//         return view('welcome');
//     });
// });
