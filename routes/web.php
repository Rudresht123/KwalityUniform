<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteRecord;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ScreenLockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\School\SchoolProductController;
use App\Http\Controllers\Vendor\CategoryController;
use App\Http\Controllers\Vendor\ColorController;
use App\Http\Controllers\Vendor\ParentCategoryController;
use App\Http\Controllers\Vendor\SizeController;
use App\Http\Controllers\Vendor\StockHistoryReportController;
use App\Http\Middleware\CheckScreenLock;
use Illuminate\Support\Facades\Route;

// Protect all administrative routes with auth and prefix 'eschoolkart'
Route::prefix('eschoolkart')->group(function () {
    Route::middleware(['auth', 'role:super-admin|admin|school|vendor', CheckScreenLock::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/lock-screen-action', [ScreenLockController::class, 'lock'])->name('lockscreen.lock');

        Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/notifications/hide', [NotificationController::class, 'hide'])->name('notifications.hide');

        require __DIR__ . '/superadmin-routes.php';

        Route::resource('parents', \App\Http\Controllers\Parent\WebUserController::class);

        Route::get('global-settings', [\App\Http\Controllers\SuperAdmin\GlobalSettingController::class, 'index'])->name('global-settings.index');
        Route::put('global-settings', [\App\Http\Controllers\SuperAdmin\GlobalSettingController::class, 'update'])->name('global-settings.update');
    });
});

// School Product Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/school-products/standards', [SchoolProductController::class, 'getStandards'])
        ->name('school.products.standards');

    Route::get('/school-products', [SchoolProductController::class, 'index'])
        ->name('school.products.index');

    Route::get('/school-products/approved', [SchoolProductController::class, 'approved'])
        ->name('school.products.approved');

    Route::get('/school-products/{productId}', [SchoolProductController::class, 'show'])
        ->name('school.products.show');

    Route::post('/school-products/{productId}/approve', [SchoolProductController::class, 'approveProduct']);

    Route::post('/school-products/{productId}/unapprove', [SchoolProductController::class, 'unapproveProduct']);
});

// Screen Lock specialized routes within super-admin prefix
Route::middleware(['auth'])->group(function () {
    Route::get('/screen-lock', [ScreenLockController::class, 'show'])->name('lockscreen');
    Route::post('/screen-unlock', [ScreenLockController::class, 'unlock'])->name('lockscreen.unlock');
});

Route::delete('/delete-record/{table}/{id}', [DeleteRecord::class, 'deleteRecord'])->name('deleteRecord');

// Notification read (kept outside prefix if used by website, but if it's admin-only, it should be inside)
Route::middleware('auth')->get('/notifications/latest', function () {
    $notifications = auth()->user()
        ->unreadNotifications()
        ->latest()
        ->take(5)
        ->get();

    return view(
        'partials.notifications',
        compact('notifications')
    );
});

Route::get('/test-notification', function () {
    $user = \App\Models\User::findOrFail(1);
    sendNotification(
        $user,
        'product_approved',
        [
            'product_name' => 'Demo Product'
        ],
        url('/products')
    );
    return 'Notification Sent';
});

require __DIR__ . '/auth.php';
require __DIR__ . '/website-routes.php';

// Delivery & Fulfillment Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/vendor/fulfillment', \App\Http\Livewire\VendorFulfillment::class)->name('vendor.fulfillment');

     Route::middleware(['role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
     Route::get('orders/dispatch', [App\Http\Controllers\Vendor\OrderDispatchController::class, 'index'])->name('orders.dispatch');
     // New Fulfillment Hub
     Route::get('fulfillment-hub', [App\Http\Controllers\Vendor\FulfillmentHubController::class, 'index'])->name('fulfillment.hub');
     Route::get('fulfillment-hub/shipment/{shipment}', [App\Http\Controllers\Vendor\FulfillmentHubController::class, 'showShipment'])->name('fulfillment.shipment.show');
     
        Route::post('orders/dispatch', [App\Http\Controllers\Vendor\OrderDispatchController::class, 'ship'])->name('orders.ship');
     });

    Route::middleware(['role:vendor'])->prefix('vendor')->group(function () {
       
        // Stock Management
        Route::get('stock-management', [App\Http\Controllers\SuperAdmin\StockManagementController::class, 'index'])->name('vendor.stock.index');
        Route::post('stock-adjustment', [App\Http\Controllers\SuperAdmin\StockAdjustmentController::class, 'adjust'])->name('vendor.stock.adjust');
        
        // Stock History Report
        Route::get('stock-history-report', [StockHistoryReportController::class, 'index'])->name('vendor.stock.history.report');
        Route::get('stock-history-report/data', [StockHistoryReportController::class, 'data'])->name('vendor.stock.history.data');

        // Recent Orders Report
        Route::get('/recent-orders', [\App\Http\Controllers\Report\OrderReportController::class, 'index'])->name('vendor.recent-orders.index')->middleware('permission:report.recent_orders.view');
        Route::get('/recent-orders/data', [\App\Http\Controllers\Report\OrderReportController::class, 'data'])->name('vendor.recent-orders.data')->middleware('permission:report.recent_orders.view');

        // Attribute Management
        Route::resource('categories', CategoryController::class)
            ->names('category');

        Route::resource('sizes', SizeController::class)
            ->names('size');

        Route::resource('colors', ColorController::class)
            ->names('color');
    });
    Route::get('/school/distribution', \App\Http\Livewire\SchoolDistribution::class)->name('school.distribution');
    Route::get('/school/dashboard', [\App\Http\Controllers\School\DashboardController::class, 'index'])->name('school.dashboard');
    Route::get('/school/orders', [\App\Http\Controllers\School\OrderController::class, 'index'])->name('school.orders.index');
    Route::get('/school/orders/{order}', [\App\Http\Controllers\School\OrderController::class, 'show'])->name('school.orders.show');
    Route::get('/parent/orders', \App\Http\Livewire\ParentOrderTracking::class)->name('parent.orders');
});


