<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/shop', [WebsiteController::class, 'shop'])->name('website.shop');
Route::get('/shop/subcategories/{parent_id}', [WebsiteController::class, 'getSubCategories'])->name('website.shop.subcategories');
Route::get('/product/{id}/json', [WebsiteController::class, 'showJson'])->name('website.product.json');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');

Route::get('/wishlist/count', [App\Http\Controllers\Website\WishlistController::class, 'count']);
Route::get('/cart/count', [App\Http\Controllers\Website\CartController::class, 'count']);

// Cart Routes
Route::get('/cart', [App\Http\Controllers\Website\CartController::class, 'index'])->name('website.cart.index');
Route::post('/cart/add', [App\Http\Controllers\Website\CartController::class, 'add'])->name('website.cart.add');
Route::post('/cart/update', [App\Http\Controllers\Website\CartController::class, 'update'])->name('website.cart.update');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\Website\CartController::class, 'remove'])->name('website.cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\Website\CartController::class, 'clear'])->name('website.cart.clear');
Route::get('/checkout', [App\Http\Controllers\Website\CartController::class, 'checkout'])->name('website.checkout'); 
Route::post('/checkout/save', [App\Http\Controllers\Website\CartController::class, 'saveCheckoutDetails'])->name('website.checkout.save');
Route::get('/checkout/confirmation', [App\Http\Controllers\Website\CartController::class, 'confirmation'])->name('website.checkout.confirmation');
Route::post('/checkout/store', [App\Http\Controllers\Website\CartController::class, 'store'])->name('website.order.store');
Route::get('/checkout/success', [App\Http\Controllers\Website\CartController::class, 'success'])->name('website.checkout.success');

Route::post('/contact/send', [App\Http\Controllers\Website\WebsiteController::class, 'storeContact'])->name('website.contact.send');

Route::prefix('order')->group(function () {
    Route::get('/success/{orderId}', [App\Http\Controllers\Website\OrderConfirmationController::class, 'show'])->name('website.order.success');
    Route::get('/download/{orderId}', [App\Http\Controllers\Website\OrderConfirmationController::class, 'downloadInvoice'])->name('website.order.download');
    Route::get('/stream/{orderId}', [App\Http\Controllers\Website\OrderConfirmationController::class, 'streamInvoice'])->name('website.order.stream');
    Route::post('/email-invoice/{orderId}', [App\Http\Controllers\Website\OrderConfirmationController::class, 'emailInvoice'])->name('website.order.email');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', [App\Http\Controllers\Website\OrderHistoryController::class, 'index'])->name('website.orders.index');
    Route::get('/my-orders/{order}', [App\Http\Controllers\Website\OrderHistoryController::class, 'show'])->name('website.orders.show');
    Route::get('/my-orders/{order}/pdf', [App\Http\Controllers\Website\OrderHistoryController::class, 'downloadPdf'])->name('website.orders.pdf');
    
    Route::get('/wishlist', [App\Http\Controllers\Website\WishlistController::class, 'index'])->name('website.wishlist.index');
    Route::post('/wishlist/add', [App\Http\Controllers\Website\WishlistController::class, 'store'])->name('website.wishlist.add');
    Route::post('/wishlist/toggle', [App\Http\Controllers\Website\WishlistController::class, 'toggle'])->name('website.wishlist.toggle');
    Route::delete('/wishlist/{id}', [App\Http\Controllers\Website\WishlistController::class, 'destroy'])->name('website.wishlist.remove');
    Route::get('/recently-viewed', [App\Http\Controllers\Website\WebsiteController::class, 'recentlyViewed'])->name('website.recently-viewed');
});

Route::post('/partnership/school', [WebsiteController::class, 'storeSchoolPartnership'])->name('website.partnership.school');
Route::post('/partnership/vendor', [WebsiteController::class, 'storeVendorPartnership'])->name('website.partnership.vendor');

Route::get('/api/schools/search', [App\Http\Controllers\Website\SchoolSearchController::class, 'search'])->name('website.schools.search');
Route::get('/api/schools/{school_id}/standards', [App\Http\Controllers\Website\SchoolSearchController::class, 'standards'])->name('website.schools.standards');