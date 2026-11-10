<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ServiceController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\BookingController;

// مسار لعرض صفحة نموذج الحجز واختيار التاريخ
Route::get('/book/{service}', [BookingController::class, 'create'])->middleware(['auth'])->name('book.create');

// مسار لاستقبال البيانات وحفظ الحجز في قاعدة البيانات
Route::post('/book', [BookingController::class, 'store'])->middleware(['auth'])->name('book.store');

Route::post('/admin/booking/{id}/{status}', [BookingController::class, 'updateStatus'])
    ->middleware(['auth'])
    ->name('admin.booking.status');
Route::post('/booking/cancel/{id}', [BookingController::class, 'cancel'])->middleware(['auth'])->name('booking.cancel');

