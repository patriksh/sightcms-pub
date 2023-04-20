<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/preferences', 'App\Http\Controllers\API\PreferenceController@index');

Route::get('/articles', 'App\Http\Controllers\API\ArticleController@index');
Route::get('/articles/categories', 'App\Http\Controllers\API\ArticleController@categories');
Route::get('/articles/{slug}', 'App\Http\Controllers\API\ArticleController@show');

Route::get('/events', 'App\Http\Controllers\API\EventController@index');
Route::get('/events/{slug}', 'App\Http\Controllers\API\EventController@show');

Route::get('/documents', 'App\Http\Controllers\API\DocumentController@index');
Route::get('/documents/categories', 'App\Http\Controllers\API\DocumentController@categories');

Route::get('/attractions', 'App\Http\Controllers\API\AttractionController@index');
Route::get('/attractions/categories', 'App\Http\Controllers\API\AttractionController@categories');
Route::get('/attractions/{slug}', 'App\Http\Controllers\API\AttractionController@show');

Route::get('/gastros', 'App\Http\Controllers\API\GastroController@index');
Route::get('/gastros/categories', 'App\Http\Controllers\API\GastroController@categories');
Route::get('/gastros/{slug}', 'App\Http\Controllers\API\GastroController@show');

Route::get('/audio-tours', 'App\Http\Controllers\API\AudioTourController@index');
Route::get('/audio-tours/{slug}', 'App\Http\Controllers\API\AudioTourController@show');

Route::get('/pages', 'App\Http\Controllers\API\PageController@index');
Route::get('/pages/{slug}', 'App\Http\Controllers\API\PageController@show');