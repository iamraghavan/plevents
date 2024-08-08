<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\FirebaseAuthController;
use App\Http\Middleware\AuthenticateAdmin;


// web.php
Route::get('/admin/login', [FirebaseAuthController::class, 'showLoginForm'])->name('login');
Route::post('/auth/admin/login', [FirebaseAuthController::class, 'login'])->name('auth.admin-login');


Route::middleware([AuthenticateAdmin::class, \Illuminate\Session\Middleware\StartSession::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});;

Route::get('/', [PageControllers::class, 'home'])->name('index');