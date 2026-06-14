<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\VendorController;
use App\Http\Controllers\SuperAdmin\SchoolController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\SchoolClassController;

Route::prefix('vendors')->name('vendor.')->group(function () {
    Route::get('/index', [VendorController::class, 'index'])->name('index')->middleware('permission:vendor.view');
    Route::get('/create', [VendorController::class, 'create'])->name('create')->middleware('permission:vendor.create');
    Route::post('/store', [VendorController::class, 'store'])->name('store')->middleware('permission:vendor.create');
    Route::get('/edit/{vendor}', [VendorController::class, 'edit'])->name('edit')->middleware('permission:vendor.edit');
    Route::put('/update/{vendor}', [VendorController::class, 'update'])->name('update')->middleware('permission:vendor.edit');
    Route::delete('/delete/{vendor}', [VendorController::class, 'destroy'])->name('destroy')->middleware('permission:vendor.delete');
    Route::get('/show/{vendor}', [VendorController::class, 'show'])->name('show')->middleware('permission:vendor.view');
});

Route::prefix('schools')->name('school.')->group(function () {
    Route::get('/index', [SchoolController::class, 'index'])->name('index')->middleware('permission:school.view');
    Route::get('/create', [SchoolController::class, 'create'])->name('create')->middleware('permission:school.create');
    Route::post('/store', [SchoolController::class, 'store'])->name('store')->middleware('permission:school.create');
    Route::get('/edit/{school}', [SchoolController::class, 'edit'])->name('edit')->middleware('permission:school.edit');
    Route::put('/update/{school}', [SchoolController::class, 'update'])->name('update')->middleware('permission:school.edit');
    Route::delete('/delete/{school}', [SchoolController::class, 'destroy'])->name('destroy')->middleware('permission:school.delete');
    Route::get('/show/{school}', [SchoolController::class, 'show'])->name('show')->middleware('permission:school.view');
});

Route::prefix('roles')->name('role.')->group(function () {
    Route::get('/index', [RoleController::class, 'index'])->name('index')->middleware('permission:role.view');
    Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('permission:role.create');
    Route::post('/store', [RoleController::class, 'store'])->name('store')->middleware('permission:role.create');
    Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit')->middleware('permission:role.edit');
    Route::put('/update/{role}', [RoleController::class, 'update'])->name('update')->middleware('permission:role.edit');
    Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('destroy')->middleware('permission:role.delete');
    Route::get('/show/{role}', [RoleController::class, 'show'])->name('show')->middleware('permission:role.view');
});

Route::prefix('school-classes')->name('school-class.')->group(function () {
    Route::get('/index', [SchoolClassController::class, 'index'])->name('index')->middleware('permission:school_class.view');
    Route::get('/create', [SchoolClassController::class, 'create'])->name('create')->middleware('permission:school_class.create');
    Route::post('/store', [SchoolClassController::class, 'store'])->name('store')->middleware('permission:school_class.create');
    Route::get('/manage/{school}', [SchoolClassController::class, 'edit'])->name('edit')->middleware('permission:school_class.edit');
    Route::put('/update/{school}', [SchoolClassController::class, 'update'])->name('update')->middleware('permission:school_class.edit');
    Route::delete('/delete/{schoolClass}', [SchoolClassController::class, 'destroy'])->name('destroy')->middleware('permission:school_class.delete');
});

Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\CategoryController::class, 'index'])->name('index')->middleware('permission:category.view');
    Route::get('/create', [\App\Http\Controllers\SuperAdmin\CategoryController::class, 'create'])->name('create')->middleware('permission:category.create');
    Route::post('/store', [\App\Http\Controllers\SuperAdmin\CategoryController::class, 'store'])->name('store')->middleware('permission:category.create');
    Route::get('/edit/{category}', [\App\Http\Controllers\SuperAdmin\CategoryController::class, 'edit'])->name('edit')->middleware('permission:category.edit');
    Route::put('/update/{category}', [\App\Http\Controllers\SuperAdmin\CategoryController::class, 'update'])->name('update')->middleware('permission:category.edit');
    Route::delete('/delete/{category}', [\App\Http\Controllers\SuperAdmin\CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:category.delete');
});

Route::prefix('parent-categories')->name('parent-category.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\ParentCategoryController::class, 'index'])->name('index')->middleware('permission:category.view');
    Route::get('/create', [\App\Http\Controllers\SuperAdmin\ParentCategoryController::class, 'create'])->name('create')->middleware('permission:category.create');
    Route::post('/store', [\App\Http\Controllers\SuperAdmin\ParentCategoryController::class, 'store'])->name('store')->middleware('permission:category.create');
    Route::get('/edit/{parent_category}', [\App\Http\Controllers\SuperAdmin\ParentCategoryController::class, 'edit'])->name('edit')->middleware('permission:category.edit');
    Route::put('/update/{parent_category}', [\App\Http\Controllers\SuperAdmin\ParentCategoryController::class, 'update'])->name('update')->middleware('permission:category.edit');
    Route::delete('/delete/{parent_category}', [\App\Http\Controllers\SuperAdmin\ParentCategoryController::class, 'destroy'])->name('destroy')->middleware('permission:category.delete');
});

Route::prefix('audit-logs')->name('audit.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\AuditReportController::class, 'index'])->name('index')->middleware('permission:audit.view');
    Route::get('/show/{activity}', [\App\Http\Controllers\SuperAdmin\AuditReportController::class, 'show'])->name('show')->middleware('permission:audit.view');
});