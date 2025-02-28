<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController as PublicOrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController; // Добавляем импорт
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DishRatingController;


// Публичные роуты
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/order', [PublicOrderController::class, 'store'])->name('order.store');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store'); // Только для авторизованных

// Роуты аутентификации
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Админ-панель (только для авторизованных админов)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('dishes', DishController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('categories', CategoryController::class);
});
// Личный кабинет
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/orders/{order}', [ProfileController::class, 'show'])->name('profile.orders.show');
Route::post('/profile/orders/{order}/cancel', [ProfileController::class, 'cancel'])->name('profile.orders.cancel');

//корзина
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/order', [PublicOrderController::class, 'store'])->name('order.store');

Route::post('/dishes/{dish}/rate', [DishRatingController::class, 'store'])->name('dishes.rate');