<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteRecord;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ScreenLockController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\CheckScreenLock;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->to('login');
// });




// Protect all main routes with CheckScreenLock
Route::middleware(['auth', CheckScreenLock::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lock-screen-action', [ScreenLockController::class, 'lock'])->name('lockscreen.lock');

    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/hide', [NotificationController::class, 'hide'])->name('notifications.hide');

    Route::get('/school-products', [\App\Http\Controllers\School\SchoolProductController::class, 'index'])
        ->middleware('can:school.product.view')
        ->name('school.products.index');

    require __DIR__ . '/superadmin-routes.php';


});


// Screen Lock specialized routes
Route::middleware(['auth'])->group(function () {
    Route::get('/screen-lock', [ScreenLockController::class, 'show'])->name('lockscreen');
    Route::post('/screen-unlock', [ScreenLockController::class, 'unlock'])->name('lockscreen.unlock');
});

Route::delete('/delete-record/{table}/{id}', [DeleteRecord::class, 'deleteRecord'])->name('deleteRecord');

// Notification read
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
