<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', function () {
        return view('pages.auth.login');
    })->middleware('auth');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', function () {
        return view('pages.users.list');
    })->name('users.index');
    Route::get('/{id}', function () {
        return view('pages.users.list_locations');
    })->name('users.locations');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', function () {
        return view('pages.admin.dashboard');
    });
});

