<?php

use App\Router\Route;

Route::get('/', function () {
    require_once "views/login.php";
});

Route::get('/test2', function () {
    print_r('im working2');
});

Route::get('/test3', function () {
    print_r('get working3');
});

Route::post('/test3', function () {
    print_r('post working3');
});

Route::get('/register', function() {
    require_once "views/register.php";
});

Route::get('/login', function() {
    require_once "views/login.php";
});

Route::get('/home', function() {
    require_once "views/home.php";
});