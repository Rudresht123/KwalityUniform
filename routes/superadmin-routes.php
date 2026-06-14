<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\VendorController;
use App\Http\Controllers\SuperAdmin\SchoolController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\SchoolClassController;

Route::prefix('vendors')->name('vendor.')->group(function () {
    Route::get('/index', [VendorController::class, 'index'])->name('index');
    Route::get('/create', [VendorController::class, 'create'])->name('create');
    Route::post('/store', [VendorController::class, 'store'])->name('store');
    Route::get('/edit/{vendor}', [VendorController::class, 'edit'])->name('edit');
    Route::put('/update/{vendor}', [VendorController::class, 'update'])->name('update');
    Route::delete('/delete/{vendor}', [VendorController::class, 'destroy'])->name('destroy');
    Route::get('/show/{vendor}', [VendorController::class, 'show'])->name('show');
});

Route::prefix('schools')->name('school.')->group(function () {
    Route::get('/index', [SchoolController::class, 'index'])->name('index');
    Route::get('/create', [SchoolController::class, 'create'])->name('create');
    Route::post('/store', [SchoolController::class, 'store'])->name('store');
    Route::get('/edit/{school}', [SchoolController::class, 'edit'])->name('edit');
    Route::put('/update/{school}', [SchoolController::class, 'update'])->name('update');
    Route::delete('/delete/{school}', [SchoolController::class, 'destroy'])->name('destroy');
    Route::get('/show/{school}', [SchoolController::class, 'show'])->name('show');
});

Route::prefix('roles')->name('role.')->group(function () {
    Route::get('/index', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit');
    Route::put('/update/{role}', [RoleController::class, 'update'])->name('update');
    Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('destroy');
    Route::get('/show/{role}', [RoleController::class, 'show'])->name('show');
});

Route::prefix('school-classes')->name('school-class.')->group(function () {
    Route::get('/index', [SchoolClassController::class, 'index'])->name('index');
    Route::get('/create', [SchoolClassController::class, 'create'])->name('create');
    Route::post('/store', [SchoolClassController::class, 'store'])->name('store');
    Route::get('/manage/{school}', [SchoolClassController::class, 'edit'])->name('edit');
    Route::put('/update/{school}', [SchoolClassController::class, 'update'])->name('update');
    Route::delete('/delete/{schoolClass}', [SchoolClassController::class, 'destroy'])->name('destroy');
});