<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/bespoke', fn() => view('bespoke'))->name('bespoke');

Route::get('/api/catalog', [CatalogController::class, 'catalog'])->name('catalog.api');
Route::get('/api/pricing/{product}', [CatalogController::class, 'showPrice'])->name('catalog.price');
