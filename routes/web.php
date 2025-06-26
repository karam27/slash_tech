<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PortfolioImageController;
use App\Http\Controllers\Admin\ServiceController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('portfolio', PortfolioController::class)->names('portfolio');

    Route::delete('portfolio/images/{id}', [PortfolioImageController::class, 'destroy'])
        ->name('portfolio.image.destroy');

    Route::resource('services', ServiceController::class)->names('services');

    Route::get('messages', [ContactMessageController::class, 'index'])
        ->name('messages.index');

    Route::delete('messages/{id}', [ContactMessageController::class, 'destroy'])
        ->name('messages.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
