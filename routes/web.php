<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login/Pages/login-page');
    // return view('Toast.toast');
});


// L O G I N  R O U T E S
require_once base_path('routes\LoginRoutes.php');

// A D M I N  R O U T E S
require_once base_path('routes\AdminRoutes.php');

