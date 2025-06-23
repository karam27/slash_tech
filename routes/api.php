<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\PortfolioShowController;
use App\Http\Controllers\Api\ProjectRequestController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('services', [ServiceController::class, 'index']);
Route::get('portfolio', [PortfolioController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/project-request', [ProjectRequestController::class, 'sendEmail']);
Route::get('/portfolios/{id}', [PortfolioShowController::class, 'show']);
