<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemoUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentResultController;
use App\Http\Controllers\StudentTestController;
use App\Http\Controllers\TeacherClassController;
use App\Http\Controllers\TeacherTestController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CheckPermissionMiddleware;
use App\Http\Middleware\ClassPermissionMiddleware;
use App\Http\Middleware\TestPermissionMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('/auth')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name(name: 'auth.login');
    Route::post('/register', [AuthController::class, 'handleRegister'])->name('auth.register');
    Route::get('/google', [GoogleAuthController::class, 'googlePage'])->name('auth.google');
    Route::get('/google/callback', [GoogleAuthController::class, 'googleCallback']);

    Route::post('/logout', [AuthController::class, 'handleLogout'])->withoutMiddleware('guest')->name('auth.logout');
    Route::get('/permission', [AuthController::class, 'permissionIndex'])->withoutMiddleware('guest')->name('auth.permission.index');
    Route::post('/permission', [AuthController::class, 'handlePermission'])->withoutMiddleware('guest')->name('auth.permission.handle');
});

Route::prefix('teacher')->group(function () {
    Route::prefix('dashboard')->middleware(AuthMiddleware::class)->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('teacher.dashboard.index');
        Route::get('/upload-file', [DemoUploadController::class, 'index'])->middleware([CheckPermissionMiddleware::class])->name('dashboard.upload-file.index');
        Route::post('/upload-file', [DemoUploadController::class, 'handleUpload'])->name('dashboard.upload-file.handle');
        
        Route::resource('test', TeacherTestController::class, ['as' => 'teacher.dashboard']);
        Route::prefix('test')->group(function () {
            Route::resource('question', QuestionController::class);
        });
        
        Route::resource('class', TeacherClassController::class, ['as' => 'teacher.dashboard']);
        // Route::prefix('/class')->group(function () {
            //     Route::get('/', [ClassController::class, 'index'])->name('class.index');
            //     Route::post('/create-class', [ClassController::class, 'handleCreateclass'])->name('class.create');
            // });
            // Route::prefix('/exam')->group(function () {
            //     Route::get('/', [DashboardController::class, 'examIndex'])->name('dashboard.exam');
            //     Route::get('/create-test', [TestsController::class, 'index'])->name('create-test.index');
            //     Route::post('/create-test', [TestsController::class, 'handleCreateTest'])->name('test.create');
            //     Route::post('/create-question', [QuestionController::class, 'handleCreateQuestion'])->name('question.create');
            // });
            
    });
});


Route::prefix('student')->group(function() {
    Route::prefix('dashboard')->middleware(AuthMiddleware::class)->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('student.dashboard.index');

        Route::resource('class', StudentClassController::class, ['as' => 'student.dashboard'])->only(['index', 'show', 'destroy', 'store']);
        
        Route::resource('test', StudentTestController::class, ['as' => 'student.dashboard'])->middleware(TestPermissionMiddleware::class)->only(['index', 'show']);
        Route::prefix(prefix: 'test')->group(function() {
            Route::post('update-elapsed-time', [StudentResultController::class, 'updateElapsedTime'])->name('studentResult.updateElapsedTime');
            Route::post('get-time-passed', [StudentResultController::class, 'getTimePassed'])->name('studentResult.getTimePassed');
            Route::post('store-result', [StudentResultController::class, 'storeResult'])->name('studentResult.storeResult');
            Route::post('get-submitted-status', [StudentResultController::class, 'getSubmittedStatus'])->name('studentResult.getSubmittedStatus');
        });

        Route::get('/test/{test}/result', [StudentResultController::class, 'getResult'])
        ->middleware(TestPermissionMiddleware::class)
        ->name('student.dashboard.test.result');
    });
});
