<?php

use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\HomeController;
use App\Kernel\Router\Route;

Route::get('/', [LoginController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/register', [RegisterController::class, 'index']);

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);