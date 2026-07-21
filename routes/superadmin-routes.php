<?php

use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\AuditReportController;
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\ColorController;
use App\Http\Controllers\SuperAdmin\ParentCategoryController;
use App\Http\Controllers\SuperAdmin\ParentReportController;
use App\Http\Controllers\SuperAdmin\ParentUserController;
use App\Http\Controllers\SuperAdmin\ProductApprovalController;
use App\Http\Controllers\SuperAdmin\ProductController;
use App\Http\Controllers\SuperAdmin\ProductPreviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\VendorController;
use App\Http\Controllers\SuperAdmin\SchoolController;
use App\Http\Controllers\SuperAdmin\SchoolBoardController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\SchoolProductApprovalController;
use App\Http\Controllers\SuperAdmin\SizeController;
use App\Http\Controllers\SuperAdmin\StockAdjustmentController;
use App\Http\Controllers\SuperAdmin\StockController;
use App\Http\Controllers\SuperAdmin\StockManagementController;
use App\Http\Controllers\SuperAdmin\UserStatusReportController;
use App\Http\Controllers\SuperAdmin\SchoolStandardController;
use App\Http\Controllers\SuperAdmin\SchoolSectionController;
use App\Http\Controllers\SuperAdmin\ProductAssignmentController;
use App\Http\Controllers\SuperAdmin\PartnershipRequestController;
use App\Http\Controllers\SuperAdmin\SchoolVendorMappingController;
use App\Http\Controllers\SuperAdmin\CourierController;
use App\Http\Controllers\Report\OrderReportController;

Route::prefix('couriers')->name('couriers.')->group(function () {
    Route::get('/index', [CourierController::class, 'index'])->name('index')->middleware('permission:courier.view');
    Route::get('/create', [CourierController::class, 'create'])->name('create')->middleware('permission:courier.create');
    Route::post('/store', [CourierController::class, 'store'])->name('store')->middleware('permission:courier.create');
    Route::get('/edit/{courier}', [CourierController::class, 'edit'])->name('edit')->middleware('permission:courier.edit');
    Route::put('/update/{courier}', [CourierController::class, 'update'])->name('update')->middleware('permission:courier.edit');
    Route::delete('/delete/{courier}', [CourierController::class, 'destroy'])->name('destroy')->middleware('permission:courier.delete');
});

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/recent-orders', [OrderReportController::class, 'index'])->name('recent-orders.index')->middleware('permission:report.recent_orders.view');
    Route::get('/recent-orders/data', [OrderReportController::class, 'data'])->name('recent-orders.data')->middleware('permission:report.recent_orders.view');
});

Route::prefix('school-vendor-mapping')->name('school-vendor-mapping.')->group(function () {
    Route::get('/index', [SchoolVendorMappingController::class, 'index'])->name('index')->middleware('permission:school_vendor.view');
    Route::get('/create', [SchoolVendorMappingController::class, 'create'])->name('create')->middleware('permission:school_vendor.create');
    Route::post('/store', [SchoolVendorMappingController::class, 'store'])->name('store')->middleware('permission:school_vendor.create');
    Route::delete('/delete/{id}', [SchoolVendorMappingController::class, 'destroy'])->name('destroy')->middleware('permission:school_vendor.delete');
});

Route::prefix('partnerships')->name('partnership.')->group(function () {
    Route::get('/index', [PartnershipRequestController::class, 'index'])->name('index')->middleware('permission:partnership.view');
    Route::post('/approve-school/{id}', [PartnershipRequestController::class, 'approveSchoolRequest'])->name('approve-school')->middleware('permission:partnership.approve');
    Route::post('/approve-vendor/{id}', [PartnershipRequestController::class, 'approveVendorRequest'])->name('approve-vendor')->middleware('permission:partnership.approve');
    Route::post('/reject/{type}/{id}', [PartnershipRequestController::class, 'rejectRequest'])->name('reject')->middleware('permission:partnership.reject');
});

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



Route::prefix('school-sections')->name('school-section.')->group(function () {
    Route::get('/index/{schoolStandard}', [SchoolSectionController::class, 'index'])->name('index')->middleware('permission:school_standard.view');
    Route::post('/store', [SchoolSectionController::class, 'store'])->name('store')->middleware('permission:school_standard.create');
    Route::delete('/delete/{schoolSection}', [SchoolSectionController::class, 'destroy'])->name('destroy')->middleware('permission:school_standard.delete');
});

Route::prefix('product-assignments')->name('product-assignment.')->group(function () {
    Route::get('/index/{product}', [ProductAssignmentController::class, 'index'])->name('index')->middleware('permission:product.view');
    Route::post('/store', [ProductAssignmentController::class, 'store'])->name('store')->middleware('permission:product.edit');
    Route::delete('/delete/{productAssignment}', [ProductAssignmentController::class, 'destroy'])->name('destroy')->middleware('permission:product.edit');
});

Route::prefix('audit-logs')->name('audit.')->group(function () {
    Route::get('/index', [AuditReportController::class, 'index'])->name('index')->middleware('permission:audit.view');
    Route::get('/show/{activity}', [AuditReportController::class, 'show'])->name('show')->middleware('permission:audit.view');
});

Route::prefix('parent-users')->name('parent-user.')->group(function () {
    Route::get('/index', [ParentUserController::class, 'index'])->name('index')->middleware('permission:parent.view');
    Route::get('/create', [ParentUserController::class, 'create'])->name('create')->middleware('permission:parent.create');
    Route::post('/store', [ParentUserController::class, 'store'])->name('store')->middleware('permission:parent.create');
    Route::get('/edit/{user}', [ParentUserController::class, 'edit'])->name('edit')->middleware('permission:parent.edit');
    Route::put('/update/{user}', [ParentUserController::class, 'update'])->name('update')->middleware('permission:parent.edit');
    Route::delete('/delete/{user}', [ParentUserController::class, 'destroy'])->name('destroy')->middleware('permission:parent.delete');
    Route::get('/report', [ParentReportController::class, 'index'])->name('report')->middleware('permission:parent.view');
    Route::get('/show', [ParentReportController::class, 'show'])->name('show')->middleware('permission:parent.show');
});

Route::prefix('admins')->name('admin.')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('index')->middleware('permission:admin.view');
    Route::get('/create', [AdminController::class, 'create'])->name('create')->middleware('permission:admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('store')->middleware('permission:admin.create');
    Route::get('/show/{admin}', [AdminController::class, 'show'])->name('show')->middleware('permission:admin.view');
    Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('edit')->middleware('permission:admin.edit');
    Route::put('/update/{admin}', [AdminController::class, 'update'])->name('update')->middleware('permission:admin.edit');
    Route::delete('/delete/{admin}', [AdminController::class, 'destroy'])->name('destroy')->middleware('permission:admin.delete');
});

Route::prefix('school-product-approvals')->name('school-product-approval.')->group(function () {
    Route::get('/index', [SchoolProductApprovalController::class, 'index'])->name('index')->middleware('permission:product_approval_view');
    Route::get('/approved', [SchoolProductApprovalController::class, 'approved'])->name('approved')->middleware('permission:product_approval_view');
    Route::get('/school-approved', [SchoolProductApprovalController::class, 'schoolApproved'])->name('school_approved')->middleware('permission:product_approval_view');
    Route::post('/approve', [SchoolProductApprovalController::class, 'approve'])->name('approve')->middleware('permission:product_approval_action');
    Route::post('/reject', [SchoolProductApprovalController::class, 'reject'])->name('reject')->middleware('permission:product_approval_action');
});

Route::prefix('product-previews')->name('product-preview.')->group(function () {
    Route::get('/{id}', [ProductPreviewController::class, 'show'])->name('show')->middleware('permission:product.view');
});

Route::prefix('user-status-report')->name('user-status-report.')->group(function () {
    Route::get('/index', [UserStatusReportController::class, 'index'])->name('index')->middleware('permission:user.view');
    Route::post('/toggle', [UserStatusReportController::class, 'toggleStatus'])->name('toggle')->middleware('permission:user.edit');
});

Route::prefix('product-approvals')->name('product-approval.')->group(function () {
    Route::get('/index', [ProductApprovalController::class, 'index'])->name('index')->middleware('permission:product_approval_view');
    Route::get('/approved', [ProductApprovalController::class, 'approved'])->name('approved')->middleware('permission:product_approval_view');
    Route::get('/preview/{productId}', [ProductApprovalController::class, 'preview'])->name('preview')->middleware('permission:product_approval_view');
    Route::post('/approve/{productId?}', [ProductApprovalController::class, 'approve'])->name('approve')->middleware('permission:product_approval_action');
    Route::post('/reject', [ProductApprovalController::class, 'reject'])->name('reject')->middleware('permission:product_approval_action');
});

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index')->middleware('permission:product.view');
    Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware('permission:product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('store')->middleware('permission:product.create');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('show')->middleware('permission:product.view');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit')->middleware('permission:product.edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('update')->middleware('permission:product.edit');
    Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('destroy')->middleware('permission:product.delete');
});

Route::prefix('stock-management')->name('stock-management.')->group(function () {
    Route::get('/index', [StockManagementController::class, 'index'])->name('index')->middleware('permission:stock_view');
});

use App\Http\Controllers\SuperAdmin\StockHistoryReportController;
use App\Services\DashboardService;

use App\Http\Controllers\SuperAdmin\ImpersonationController;

// ... other imports

Route::middleware(['auth', 'role:super-admin'])->prefix('impersonate')->name('impersonate.')->group(function () {
    Route::get('/start/{user}', [ImpersonationController::class, 'start'])->name('start');
    Route::get('/stop', [ImpersonationController::class, 'stop'])->name('stop');
});

// ... other routes

Route::prefix('stock-adjustment')->name('stock-adjustment.')->group(function () {
    Route::post('/adjust', [StockAdjustmentController::class, 'adjust'])->name('adjust')->middleware('permission:stock_adjust');
});

Route::prefix('stock-history')->name('stock-history.')->group(function () {
    Route::get('/report', [StockHistoryReportController::class, 'index'])->name('index')->middleware('permission:stock_history_view');
    Route::get('/data', [StockHistoryReportController::class, 'data'])->name('data')->middleware('permission:stock_history_view');
});

Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/index', [StockController::class, 'index'])->name('index')->middleware('permission:stock_view');
});

Route::prefix('parent-categories')->name('parent-category.')->group(function () {
    Route::get('/index', [ParentCategoryController::class, 'index'])->name('index')->middleware('permission:parent_category.view');
    Route::get('/create', [ParentCategoryController::class, 'create'])->name('create')->middleware('permission:parent_category.create');
    Route::post('/store', [ParentCategoryController::class, 'store'])->name('store')->middleware('permission:parent_category.create');
    Route::get('/edit/{parentCategory}', [ParentCategoryController::class, 'edit'])->name('edit')->middleware('permission:parent_category.edit');
    Route::put('/update/{parentCategory}', [ParentCategoryController::class, 'update'])->name('update')->middleware('permission:parent_category.edit');
    Route::delete('/delete/{parentCategory}', [ParentCategoryController::class, 'destroy'])->name('destroy')->middleware('permission:parent_category.delete');
});

Route::middleware(['auth', 'role:super-admin|admin|school|vendor'])->group(function () {
  
  
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('/vendor/order-inventory-health', [DashboardService::class, 'getVendorInventoryHealth'])->name('vendor.invntory-health');
        Route::get('/vendor/order-status-ditribution', [DashboardService::class, 'getVendorOrderStatusDistribution'])->name('vendor.order-status-ditribution');
        Route::get('/vendor/revenu-trend', [DashboardService::class, 'revenuTrend'])->name('vendor.revenu-trend');
        Route::get('/vendor/order-trend', [DashboardService::class, 'getVendorOrderTrend'])->name('vendor.order-trend');
        Route::post('/parent-category/store', [ParentCategoryController::class, 'ajaxStore'])->name('parent-category.store');
        Route::post('/category/store', [CategoryController::class, 'ajaxStore'])->name('category.store');
        Route::post('/size/store', [SizeController::class, 'ajaxStore'])->name('size.store');
        Route::post('/color/store', [ColorController::class, 'ajaxStore'])->name('color.store');
    });
});

