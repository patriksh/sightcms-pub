<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing page routes.
Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index')->name('landing');
    Route::get('get-started', 'getStarted')->name('get-started');
    Route::get('contact', 'contact')->name('contact');
    Route::post('contact', 'contactPost')->name('contact.post');
    Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
    Route::get('terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions');
});

// User routes.
Route::middleware(['auth', 'verified'])->group(function() {
    // Dashboard.
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile.
    Route::controller(ProfileController::class)->name('profile.')->group(function() {
        Route::get('profile', 'edit')->name('edit');
        Route::patch('profile', 'update')->name('update');
        Route::delete('profile', 'destroy')->name('destroy');
    });

    // Website routes.
    Route::controller(WebsiteController::class)->name('website.')->group(function() {
        Route::get('websites', 'list')->name('list');
        Route::get('website/{id}/edit/', 'edit')->name('edit');
        Route::patch('website/{id}/edit/', 'update')->name('update');
        Route::get('website/{id}/dashboard/', 'redirectToDashboard')->name('dashboard');
    });

    // Website Builder routes.
    Route::controller(BuilderController::class)->middleware('builder')->prefix('builder/')->name('builder.')->group(function() {
        Route::get('intro', 'intro')->name('intro');
        Route::get('step-1', 'step1')->name('step1');
        Route::post('step-1', 'step1Post')->name('step1Post');
        Route::get('step-2', 'step2')->name('step2');
        Route::post('step-2', 'step2Post')->name('step2Post');
        Route::get('step-3', 'step3')->name('step3');
        Route::post('step-3', 'step3Post')->name('step3Post');
        Route::get('finish', 'finish')->name('finish');
    });
    
});

// Change language route.
Route::get('language/{language}', [LanguageController::class, 'set'])->name('language.set');

require __DIR__ . '/auth.php';