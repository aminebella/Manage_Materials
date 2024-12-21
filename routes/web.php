<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/equipements', function () {
    return view('equipements');
})->name('equipements');

Route::get('/requests', function () {
    return view('requests');
})->name('requests');

Route::get('/maintenance', function () {
    return view('maintenance');
})->name('maintenance');
