<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteRecord;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ScreenLockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\School\SchoolProductController;
use App\Http\Middleware\CheckScreenLock;
use Illuminate\Support\Facades\Route;

// Protect all administrative routes with auth and prefix 'super-admin'
Route::prefix('super-admin')->group(function () {
    Route::middleware(['auth', 'role:Super Admin|Admin', CheckScreenLock::class])->group(function () {
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
    Route::get('/school/distribution', \App\Http\Livewire\SchoolDistribution::class)->name('school.distribution');
    Route::get('/parent/orders', \App\Http\Livewire\ParentOrderTracking::class)->name('parent.orders');
});
