<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

});

Route::middleware(['auth', 'role:Teacher'])->group(function () {

    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index']);

});

Route::middleware(['auth', 'role:Student'])->group(function () {

    Route::get('/student/dashboard', [StudentDashboardController::class, 'index']);

});

require __DIR__.'/auth.php';
