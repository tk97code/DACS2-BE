<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemoUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestResourceController;
use App\Http\Controllers\TestsController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CheckPermissionMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('/auth')->middleware('guest')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name(name: 'auth.login');
    Route::post('/register', [AuthController::class, 'handleRegister'])->name('auth.register');
    Route::get('/google', [GoogleAuthController::class, 'googlePage'])->name('auth.google');
    Route::get('/google/callback', [GoogleAuthController::class, 'googleCallback']);

    Route::post('/logout', [AuthController::class, 'handleLogout'])->withoutMiddleware('guest')->name('auth.logout');
    Route::get('/permission', [AuthController::class, 'permissionIndex'])->withoutMiddleware('guest')->name('auth.permission.index');
    Route::post('/permission', [AuthController::class, 'handlePermission'])->withoutMiddleware('guest')->name('auth.permission.handle');
});

Route::prefix('/dashboard')->middleware(AuthMiddleware::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/upload-file', [DemoUploadController::class, 'index'])->middleware([CheckPermissionMiddleware::class])->name('dashboard.upload-file.index');
    Route::post('/upload-file', [DemoUploadController::class, 'handleUpload'])->name('dashboard.upload-file.handle');
    // Route::prefix('/exam')->group(function () {
    //     Route::get('/', [DashboardController::class, 'examIndex'])->name('dashboard.exam');
    //     Route::get('/create-test', [TestsController::class, 'index'])->name('create-test.index');
    //     Route::post('/create-test', [TestsController::class, 'handleCreateTest'])->name('test.create');
    //     Route::post('/create-question', [QuestionController::class, 'handleCreateQuestion'])->name('question.create');
    // });

    Route::resource('test', TestController::class);
    Route::prefix('test')->group(function() {
        Route::resource('question', QuestionController::class);
    });

    Route::prefix('/class')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('class.index');
        Route::post('/create-class', [ClassController::class, 'handleCreateclass'])->name('class.create');
    });
});








