<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TVController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\KoreanDramaController;

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

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');

Route::get('/tv', [TVController::class, 'index'])->name('tv.index');
Route::get('/tv/{id}', [TVController::class, 'show'])->name('tv.show');

Route::get('/actors', [ActorsController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{number?}', [ActorsController::class, 'index']);
Route::get('/actors/{actor}', [ActorsController::class, 'show'])->name('actors.show');

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/page/{number?}', [SearchController::class, 'search']);
Route::post('/search', [SearchController::class, 'search'])->name('postSearch');

Route::get('/korean-drama', [KoreanDramaController::class, 'index'])->name('koreanDrama.index');
Route::get('/korean-drama/fetch/{year}/{number?}', [KoreanDramaController::class, 'fetch'])->name('koreanDrama.fetch');
Route::get('/korean-drama/page/{number?}/{year?}', [KoreanDramaController::class, 'index']);
