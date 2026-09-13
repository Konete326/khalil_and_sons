<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CustomOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'catalog'])->name('catalog');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/bespoke', fn() => view('bespoke'))->name('bespoke');

Route::get('/api/catalog', [CatalogController::class, 'catalog'])->name('catalog.api');
Route::get('/api/pricing/{product}', [CatalogController::class, 'showPrice'])->name('catalog.price');

Route::post('/api/atelier/chat', [CustomOrderController::class, 'chat'])->name('atelier.chat');
Route::post('/api/atelier/generate-3d', [CustomOrderController::class, 'generate3D'])->name('atelier.3d');
Route::get('/api/atelier/poll-3d/{taskId}', [CustomOrderController::class, 'poll3D'])->name('atelier.poll3d');
Route::post('/api/atelier/order', [CustomOrderController::class, 'storeOrder'])->name('atelier.order');
Route::post('/api/atelier/order/{code}/slip', [CustomOrderController::class, 'uploadSlip'])->name('atelier.slip');
Route::get('/track/{code?}', [CustomOrderController::class, 'track'])->name('track');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/rates', [Admin\RateController::class, 'index'])->name('rates.index');
        Route::post('/rates/update', [Admin\RateController::class, 'update'])->name('rates.update');
        Route::post('/rates/sync', [Admin\RateController::class, 'sync'])->name('rates.sync');

        Route::get('/orders', [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/payment', [Admin\OrderController::class, 'updatePayment'])->name('orders.payment');
        Route::post('/orders/{order}/stage', [Admin\OrderController::class, 'updateStage'])->name('orders.stage');

        Route::get('/payments', [Admin\PaymentMethodController::class, 'index'])->name('payments.index');
        Route::post('/payments/{paymentMethod}', [Admin\PaymentMethodController::class, 'update'])->name('payments.update');
    });
});
