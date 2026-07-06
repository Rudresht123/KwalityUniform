<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/shop', [WebsiteController::class, 'shop'])->name('website.shop');
Route::get('/shop/subcategories/{parent_id}', [WebsiteController::class, 'getSubCategories'])->name('website.shop.subcategories');
Route::get('/product/{id}', [WebsiteController::class, 'show'])->name('website.product.show');
Route::get('/product/{id}/json', [WebsiteController::class, 'showJson'])->name('website.product.json');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');

// Cart Routes
Route::get('/cart', [App\Http\Controllers\Website\CartController::class, 'index'])->name('website.cart.index');
Route::post('/cart/add', [App\Http\Controllers\Website\CartController::class, 'add'])->name('website.cart.add');
Route::post('/cart/update', [App\Http\Controllers\Website\CartController::class, 'update'])->name('website.cart.update');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\Website\CartController::class, 'remove'])->name('website.cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\Website\CartController::class, 'clear'])->name('website.cart.clear');

Route::post('/partnership/school', [WebsiteController::class, 'storeSchoolPartnership'])->name('website.partnership.school');
Route::post('/partnership/vendor', [WebsiteController::class, 'storeVendorPartnership'])->name('website.partnership.vendor');

Route::get('/api/schools/search', [App\Http\Controllers\Website\SchoolSearchController::class, 'search'])->name('website.schools.search');
Route::get('/api/schools/{school_id}/standards', [App\Http\Controllers\Website\SchoolSearchController::class, 'standards'])->name('website.schools.standards');