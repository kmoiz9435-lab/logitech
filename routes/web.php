<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebsiteContentController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\WhyChooseController;
use Illuminate\Support\Facades\Route;

/* =========================================================
   Public Routes (Premium Industrial Frontend)
   ========================================================= */
Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::post('/inquiry', [\App\Http\Controllers\InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/sitemap.xml', \App\Http\Controllers\SitemapController::class)->name('sitemap');
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

/* =========================================================
   Admin Routes (Protected by authentication + is_admin)
   ========================================================= */
Route::prefix('admin')
    ->name('admin.')
    ->middleware('guest')
    ->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth', 'admin')
    ->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', DashboardController::class)->name('dashboard');

        // Products
        Route::resource('products', ProductController::class)->names('products');
        Route::post('products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggle-active');
        Route::post('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
        Route::delete('products/{product}/images/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');

        // Categories
        Route::resource('categories', ProductCategoryController::class)->names('categories');

        // Industries
        Route::resource('industries', IndustryController::class)->names('industries');

        // Gallery
        Route::resource('gallery', GalleryController::class)->names('gallery');

        // Why Choose Us
        Route::resource('why-choose', WhyChooseController::class)->names('why-choose');

        // Inquiries
        Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::post('inquiries/{inquiry}/update-status', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::delete('inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

        // CMS / Content
        Route::get('content', [WebsiteContentController::class, 'edit'])->name('content.edit');
        Route::put('content', [WebsiteContentController::class, 'update'])->name('content.update');

        // Company Settings
        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

        // Admin Profile
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });
