<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteRecord;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->to('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    require __DIR__.'/superadmin-routes.php';
});


Route::delete('/delete-record/{table}/{id}',[DeleteRecord::class, 'deleteRecord'])->name('deleteRecord');

require __DIR__.'/auth.php';
