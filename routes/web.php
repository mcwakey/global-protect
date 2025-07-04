<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LegalPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ManualController;
use App\Http\Controllers\Admin\LegalPageController as AdminLegalPageController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Legal pages
Route::get('/legal/{type}', [LegalPageController::class, 'show'])->name('legal.show');

// Language switching
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

// Admin routes (protected by auth middleware)
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin CRUD routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('sections', SectionController::class);
        Route::resource('features', FeatureController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
        Route::resource('legal-pages', AdminLegalPageController::class);

        // Additional contact message routes
        Route::patch('contact-messages/{contactMessage}/mark-read', [ContactMessageController::class, 'markAsRead'])
            ->name('contact-messages.mark-read');
        Route::patch('contact-messages/{contactMessage}/mark-unread', [ContactMessageController::class, 'markAsUnread'])
            ->name('contact-messages.mark-unread');

        // Settings routes
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('settings/logo', [SettingController::class, 'deleteLogo'])->name('settings.delete-logo');
        Route::delete('settings/favicon', [SettingController::class, 'deleteFavicon'])->name('settings.delete-favicon');

        // User Manual route
        Route::get('manual', [ManualController::class, 'index'])->name('manual.index');
    });

    // Original dashboard and profile routes
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
