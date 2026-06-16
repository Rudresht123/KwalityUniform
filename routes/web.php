<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteRecord;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ScreenLockController;
use App\Http\Middleware\CheckScreenLock;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->to('login');
});

// Protect all main routes with CheckScreenLock
Route::middleware(['auth', CheckScreenLock::class])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lock-screen-action', [ScreenLockController::class, 'lock'])->name('lockscreen.lock');

    Route::post('/notifications/mark-as-read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');

    require __DIR__.'/superadmin-routes.php';
});

// Screen Lock specialized routes
Route::middleware(['auth'])->group(function () {
    Route::get('/screen-lock', [ScreenLockController::class, 'show'])->name('lockscreen');
    Route::post('/screen-unlock', [ScreenLockController::class, 'unlock'])->name('lockscreen.unlock');
});

Route::delete('/delete-record/{table}/{id}',[DeleteRecord::class, 'deleteRecord'])->name('deleteRecord');

require __DIR__.'/auth.php';
