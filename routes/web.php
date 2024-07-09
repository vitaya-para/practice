<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {

    Route::get('login', [UserController::class, 'login'])->name('user.login');

    Route::post('login', [UserController::class, 'index'])->name('user.login_index');

    Route::get('registration', [UserController::class, 'registration'])->name('user.registration');
    Route::post('registration', [UserController::class, 'store'])->name('user.store');

    Route::get('login/cas', function () {
        return redirect(env('SPBSTU_LOGIN_URL'));
    })->name('user.login.cas');
});

Route::get('/', [UserController::class, 'dashboard'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('panel', [StudentController::class, 'dashboard'])->name('user.dashboard');

    Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.index');

            Route::get('courses', [AdminController::class, 'courses'])->name('admin.course');
            Route::post('courses', [ImportController::class, 'courses'])->name('admin.course_upload');

            Route::get('students', [AdminController::class, 'students'])->name('admin.students');
            Route::post('students', [ImportController::class, 'students'])->name('admin.students_upload');
    });

    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});
