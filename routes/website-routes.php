<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/shop', [WebsiteController::class, 'shop'])->name('website.shop');
Route::get('/product/{id}', [WebsiteController::class, 'show'])->name('website.product.show');
Route::get('/about', [WebsiteController::class, 'about'])->name('website.about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('website.contact');

Route::post('/partnership/school', [WebsiteController::class, 'storeSchoolPartnership'])->name('website.partnership.school');
Route::post('/partnership/vendor', [WebsiteController::class, 'storeVendorPartnership'])->name('website.partnership.vendor');

Route::get('/api/schools/search', [App\Http\Controllers\Website\SchoolSearchController::class, 'search'])->name('website.schools.search');