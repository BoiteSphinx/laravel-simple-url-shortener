<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', LinkController::class)->name('dashboard');
});
