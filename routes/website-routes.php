<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;

Route::get('/', [WebsiteController::class, 'index']);