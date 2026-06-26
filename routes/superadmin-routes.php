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

Route::prefix('sizes')->name('size.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'index'])->name('index')->middleware('permission:size.view');
    Route::get('/create', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'create'])->name('create')->middleware('permission:size.create');
    Route::post('/store', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'store'])->name('store')->middleware('permission:size.create');
    Route::get('/show/{size}', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'show'])->name('show')->middleware('permission:size.view');
    Route::get('/edit/{size}', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'edit'])->name('edit')->middleware('permission:size.edit');
    Route::put('/update/{size}', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'update'])->name('update')->middleware('permission:size.edit');
    Route::delete('/delete/{size}', [\App\Http\Controllers\SuperAdmin\SizeController::class, 'destroy'])->name('destroy')->middleware('permission:size.delete');
});

Route::prefix('colors')->name('color.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'index'])->name('index')->middleware('permission:color.view');
    Route::get('/create', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'create'])->name('create')->middleware('permission:color.create');
    Route::post('/store', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'store'])->name('store')->middleware('permission:color.create');
    Route::get('/show/{color}', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'show'])->name('show')->middleware('permission:color.view');
    Route::get('/edit/{color}', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'edit'])->name('edit')->middleware('permission:color.edit');
    Route::put('/update/{color}', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'update'])->name('update')->middleware('permission:color.edit');
    Route::delete('/delete/{color}', [\App\Http\Controllers\SuperAdmin\ColorController::class, 'destroy'])->name('destroy')->middleware('permission:color.delete');
});

Route::prefix('admins')->name('admin.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'index'])->name('index')->middleware('permission:admin.view');
    Route::get('/create', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'create'])->name('create')->middleware('permission:admin.create');
    Route::post('/store', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'store'])->name('store')->middleware('permission:admin.create');
    Route::get('/show/{admin}', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'show'])->name('show')->middleware('permission:admin.view');
    Route::get('/edit/{admin}', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'edit'])->name('edit')->middleware('permission:admin.edit');
    Route::put('/update/{admin}', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'update'])->name('update')->middleware('permission:admin.edit');
    Route::delete('/delete/{admin}', [\App\Http\Controllers\SuperAdmin\AdminController::class, 'destroy'])->name('destroy')->middleware('permission:admin.delete');
});

Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/low-stock', [\App\Http\Controllers\SuperAdmin\StockController::class, 'index'])->name('index')->middleware('permission:stock_view');
    Route::post('/adjust', [\App\Http\Controllers\SuperAdmin\StockController::class, 'adjust'])->name('adjust')->middleware('permission:stock_adjust');
});

Route::prefix('stock-management')->name('stock-management.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\StockManagementController::class, 'index'])->name('index')->middleware('permission:stock_view');
});

Route::prefix('stock-adjustments')->name('stock-adjustment.')->group(function () {
    Route::post('/adjust', [\App\Http\Controllers\SuperAdmin\StockAdjustmentController::class, 'adjust'])->name('adjust')->middleware('permission:stock_adjust');
    Route::get('/history', [\App\Http\Controllers\SuperAdmin\StockAdjustmentController::class, 'history'])->name('history')->middleware('permission:stock_history_view');
});

Route::prefix('school-product-approvals')->name('school-product-approval.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\SchoolProductApprovalController::class, 'index'])->name('index')->middleware('permission:product_approval_view');
    Route::post('/approve', [\App\Http\Controllers\SuperAdmin\SchoolProductApprovalController::class, 'approve'])->name('approve')->middleware('permission:product_approval_action');
    Route::post('/reject', [\App\Http\Controllers\SuperAdmin\SchoolProductApprovalController::class, 'reject'])->name('reject')->middleware('permission:product_approval_action');
});

Route::prefix('product-previews')->name('product-preview.')->group(function () {
    Route::get('/{id}', [\App\Http\Controllers\SuperAdmin\ProductPreviewController::class, 'show'])->name('show')->middleware('permission:product.view');
});

Route::prefix('user-status-report')->name('user-status-report.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\UserStatusReportController::class, 'index'])->name('index')->middleware('permission:user.view');
    Route::post('/toggle', [\App\Http\Controllers\SuperAdmin\UserStatusReportController::class, 'toggleStatus'])->name('toggle')->middleware('permission:user.edit');
});

Route::prefix('product-approvals')->name('product-approval.')->group(function () {


    Route::get('/index', [\App\Http\Controllers\SuperAdmin\ProductApprovalController::class, 'index'])->name('index')->middleware('permission:product_approval_view');
    Route::get('/preview/{productId}', [\App\Http\Controllers\SuperAdmin\ProductApprovalController::class, 'preview'])->name('preview')->middleware('permission:product_approval_view');
    Route::post('/approve/{productId}', [\App\Http\Controllers\SuperAdmin\ProductApprovalController::class, 'approve'])->name('approve')->middleware('permission:product_approval_action');
    Route::post('/reject/{productId}', [\App\Http\Controllers\SuperAdmin\ProductApprovalController::class, 'reject'])->name('reject')->middleware('permission:product_approval_action');
});

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/index', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'index'])->name('index')->middleware('permission:product.view');
    Route::get('/create', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'create'])->name('create')->middleware('permission:product.create');
    Route::post('/store', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'store'])->name('store')->middleware('permission:product.create');
    Route::get('/show/{product}', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'show'])->name('show')->middleware('permission:product.view');
    Route::get('/edit/{product}', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'edit'])->name('edit')->middleware('permission:product.edit');
    Route::put('/update/{product}', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'update'])->name('update')->middleware('permission:product.edit');
    Route::delete('/delete/{product}', [\App\Http\Controllers\SuperAdmin\ProductController::class, 'destroy'])->name('destroy')->middleware('permission:product.delete');
});