<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\MemberController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', HomeController::class);
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::resource('/membership', MemberController::class);

// LOGIN
Route::resource('/login', LoginController::class);

// BALANCE
Route::resource('/balance', BalanceController::class);

// LOGIN
Route::post('/loginPost', [LoginController::class, 'loginPost'])->name('loginPost');

// LOGOUT
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// // ADMIN
// Route::resource('/auth/admin', AdminController::class);
