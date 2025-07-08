<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WasteDetectionController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    // --- Registrasi ---
    // Menampilkan halaman registrasi
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    // Memproses data registrasi
    Route::post('/register', [AuthController::class, 'register']);

    // --- Login ---
    // Menampilkan halaman login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Memproses data login
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/image', [ProfileController::class, 'deleteImage'])->name('profile.delete-image');

    // Waste Detection
    Route::get('/waste/detect', [WasteDetectionController::class, 'show'])->name('waste.detect');
    Route::post('/waste/process', [WasteDetectionController::class, 'process'])->name('waste.process');
    Route::get('/waste/camera', [WasteDetectionController::class, 'camera'])->name('waste.camera');
    Route::get('/waste/result/{id}', [WasteDetectionController::class, 'result'])->name('waste.result');

    // Videos
    Route::get('/videos', [VideoController::class, 'index'])->name('videos');

    // Rewards
    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
    Route::post('/rewards/{reward}/redeem', [RewardController::class, 'redeem'])->name('rewards.redeem');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
