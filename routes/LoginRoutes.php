<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\LoginController;

// L O G O U T
Route::get('/logout', [LoginController::class, 'Logout'])->name('logout');

// R E G I S T R A T I O N  P A G E
Route::get('/register-page', function () {
    return view(view: 'Login.Pages.register-page');
})->name('register-page');

// R E G I S T R A T I O N   V A L I D A T I O N
Route::post('/register-validation', [LoginController::class, 'RegisterValidation'])->name('register-validation');

// L O G I N  V A L I D A T I O N
Route::post('/login-validation', [LoginController::class, 'LoginValidation'])->name('login-validation');

// A C C O U N T  R E Q U E S T  M A I N P A G E
Route::get('/account-request', function () {
    return view('Admin.Pages.account-request');
})->name('account-request');

// F O R G O T  P A S S W O R D  P A G E
Route::get('/forgot-passpword', function () {
    return view('Login.Pages.forgot-password-page');
})->name('forgot-password');

// O T P   A U T H E N T I C A T I O N
Route::post('/otp-authentication', [LoginController::class, 'EmailValidation'])->name('otp-authentication');

// O T P  V E R I F I C A T I O N
Route::post('/otp-verification', [LoginController::class, 'OTPVerification'])->name('otp-verification');

// C H A N G E  P A S S W O R D
Route::post('/change-password', [LoginController::class, 'ChangePasswordValidation'])->name('change-password');
