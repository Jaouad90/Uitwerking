<?php

use App\Http\Controllers\FooBarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

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

Route::get('/', [SearchController::class, 'index']);
Route::get('/search/{id}/{name}', [SearchController::class, 'searchDeparturesOfStation'])->name('stationdespartureslist');
Route::get('/tripadvice', [SearchController::class, 'searchTrip'])->name('tripadvice');