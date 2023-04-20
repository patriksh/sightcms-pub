<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\GastroController;
use App\Http\Controllers\AudioTourController;
use App\Http\Controllers\AdminTokenLoginController;
use App\Http\Controllers\ContactController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('admin-token-login/{token}', [AdminTokenLoginController::class, 'index'])->name('admin.token.login');

// Routes for various content types.

Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{slug}', [ArticleController::class, 'index'])->name('articles.category');
Route::get('article/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('event/{slug}', [EventController::class, 'show'])->name('events.show');

Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('documents/{slug}', [DocumentController::class, 'index'])->name('documents.category');

Route::get('attractions', [AttractionController::class, 'index'])->name('attractions.index');
Route::get('attractions/{slug}', [AttractionController::class, 'index'])->name('attractions.category');
Route::get('attraction/{slug}', [AttractionController::class, 'show'])->name('attractions.show');

Route::get('gastronomy', [GastroController::class, 'index'])->name('gastros.index');
Route::get('gastronomy/{slug}', [GastroController::class, 'index'])->name('gastros.category');
Route::get('gastronomy/view/{slug}', [GastroController::class, 'show'])->name('gastros.show');

Route::get('audio-tours', [AudioTourController::class, 'index'])->name('audio-tours.index');
Route::get('audio-tour/{slug}', [AudioTourController::class, 'show'])->name('audio-tours.show');

Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

// Catch-all route for static pages.
Route::get('{page}/{subs?}', [PageController::class, 'show'])->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);
