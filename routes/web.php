<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\VerifyController;
use App\Http\Controllers\PageControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;



Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/auth/admin/login', [VerifyController::class, 'login'])->name('auth.admin-login');
});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/egspec/e/portal/{token}', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('egspec/e/portal/sessions')->group(function () {
        Route::get('/{token}', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/create/{token}', [SessionController::class, 'create'])->name('sessions.create');
        Route::post('/', [SessionController::class, 'store'])->name('sessions.store');
        Route::get('/{session}/{token}', [SessionController::class, 'show'])->name('sessions.show');
        Route::get('/{session}/edit/{token}', [SessionController::class, 'edit'])->name('sessions.edit');
        Route::put('/update/{session_id}', [SessionController::class, 'update'])->name('sessions.update');


        Route::delete('/{session}', [SessionController::class, 'destroy'])->name('sessions.destroy');
    });




    Route::post('/admin/logout/session', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::get('/', [PageControllers::class, 'home'])->name('index');