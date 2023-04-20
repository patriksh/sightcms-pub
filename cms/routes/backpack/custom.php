<?php

use Illuminate\Support\Facades\Route;

// Backpack admin CRUD routes.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('user', 'UserCrudController');
    Route::crud('article', 'ArticleCrudController');
    Route::crud('article-category', 'ArticleCategoryCrudController');
    Route::crud('event', 'EventCrudController');
    Route::crud('attraction', 'AttractionCrudController');
    Route::crud('gastro', 'GastroCrudController');
    Route::crud('bike-route', 'BikeRouteCrudController');
    Route::crud('audio-tour', 'AudioTourCrudController');
    Route::crud('menu-item', 'MenuItemCrudController');
    Route::crud('home-block', 'HomeBlockCrudController');
    Route::crud('document-category', 'DocumentCategoryCrudController');
    Route::crud('document', 'DocumentCrudController');
    Route::crud('attraction-category', 'AttractionCategoryCrudController');
    Route::crud('gastro-category', 'GastroCategoryCrudController');
    Route::crud('preference', 'PreferenceCrudController');
}); // this should be the absolute last line of this file