<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('Home');
})->name('home');

Route::resource('/products', ResourceController::class);
