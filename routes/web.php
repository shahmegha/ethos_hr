<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\Users\UsersController::class, 'index'])->name('users')->middleware(App\Http\Middleware\AdminMiddleware::class);;
Route::get('/user_report', [App\Http\Controllers\Users\UserReportController::class, 'index'])->name('user_report');