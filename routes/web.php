<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;

Route::get('/', function () {
    return redirect()->route('links.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('links', LinkController::class)
        ->except('show');

    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::patch('/profile/email', [
        ProfileController::class,
        'updateEmail'
    ])->name('profile.email.update');

    Route::patch('/profile/password', [
        ProfileController::class,
        'updatePassword'
    ])->name('profile.password.update');
});

Route::get('{short_url:short_code}', RedirectController::class)
    ->name('redirect');
