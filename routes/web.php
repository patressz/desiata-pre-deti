<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AllergenController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/allergens', [PageController::class, 'allergens'])->name('allergens');
Route::get('/general-terms-and-conditions', [PageController::class, 'general_terms_and_conditions'])->name('general.terms.and.conditions');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/cookies', [PageController::class, 'cookies'])->name('cookies');


Route::middleware(['auth'])->group(function () {

    Route::resource('orders', OrderController::class)->except('index');
    Route::get('my-orders/{date}', [OrderController::class, 'index'])->where(['date' => '[0-9]{4}-[0-9]{2}-[0-9]{2}'])->name('orders.index');
    Route::get('order/select-date', [OrderController::class, 'select_date'])->name('order.select.date');

    Route::get('add-credit', [PaymentController::class, 'index'])->name('payment.home');
    Route::get('payment/checkout', [PaymentController::class, 'add_credit'])->name('payment.checkout');
    Route::post('add-credit', [PaymentController::class, 'pay'])->name('payment.add.credit');

    Route::resource('childrens', ChildrenController::class)->except(['create']);
    Route::resource('my-account', UserController::class);
    Route::put('update-password/{user_id}', [UserController::class, 'update_password'])->name('my-account.update-password');

});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('schools', SchoolController::class);
    Route::put('products/{product}/archive', [ProductController::class, 'archive'])->name('products.archive');
    Route::get('archived-products', [ProductController::class, 'archived_products'])->name('products.archived');

    Route::get('payments', [PaymentController::class, 'payments'])->name('payments');

    Route::resource('allergens', AllergenController::class)->except('show');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    Route::prefix('users')->group(function () {

        Route::put('{user}/generate-new-password', [App\Http\Controllers\Admin\UserController::class, 'generate_new_password'])->name('users.generate.new.password');
    });

    Route::prefix('settings')->group(function () {

        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::put('update-registration', [SettingController::class, 'update_registration'])->name('update.registration');
        Route::put('update-deadline', [SettingController::class, 'update_deadline'])->name('update.deadline');

    });

    Route::get('admin-orders/{date}', [App\Http\Controllers\Admin\OrderController::class, 'index'])->where(['date' => '[0-9]{4}-[0-9]{2}-[0-9]{2}'])->name('admin-orders.index');
    Route::resource('admin-orders', App\Http\Controllers\Admin\OrderController::class)->except('index', 'create', 'store', 'show', 'edit', 'update');

    Route::get('export/{date}', [App\Http\Controllers\Admin\OrderController::class, 'export'])->where(['date' => '[0-9]{4}-[0-9]{2}-[0-9]{2}'])->name('admin-orders.export');

});

require __DIR__.'/auth.php';
