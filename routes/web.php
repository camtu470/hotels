<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\BookingController;


// Trang chủ - Chỉ cho phép người chưa đăng nhập
Route::get('/', function () {
    return view('home');
})->name('home')->middleware('guest');  // Chỉ cho phép khách truy cập


// routes/web.php
Route::get('/admin/hotels/{hotel}/rooms', [\App\Http\Controllers\Admin\BookingController::class, 'getRoomsByHotel']);


// Auth routes
Auth::routes();

// Route cho Admin, yêu cầu đăng nhập và có role admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Route dashboard của admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Routes cho các chức năng quản lý của admin
    Route::resource('branches', BranchController::class);
    // Route cho quản lý khuyến mãi
    Route::resource('promotions', PromotionController::class);

    Route::resource('services', ServiceController::class);

    Route::resource('hotels', HotelController::class);

    Route::resource('rooms', RoomController::class);
    Route::resource('floors', FloorController::class);

    Route::resource('rooms', RoomController::class);
    Route::resource('guests', GuestController::class);
// routes/web.php
Route::resource('bookings', BookingController::class);
Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
// routes/web.php
Route::get('/admin/bookings/blocked-dates/{roomId}', [BookingController::class, 'getBlockedDates']);
Route::get('/admin/rooms/map', [RoomController::class, 'map'])->name('rooms.map');



});

// Route cho Customer, yêu cầu đăng nhập và có role user
Route::middleware(['auth', 'role:user'])->group(function () {
    // Route index của customer
    Route::get('/customer/index', [CustomerController::class, 'index'])->name('customer.index');
    
    Route::get('/customer/rooms', [CustomerController::class, 'searchRoom'])->name('customer.searchRoom');

});