<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Mail\ExpiredLinksSummary;
use App\Models\User;

Route::get('/', function () {
    return redirect()->route('links.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('links', LinkController::class)
        ->except('show');

    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile.index');
});

Route::get('/mailable/{user:id}', fn(User $user) => new ExpiredLinksSummary($user->shortUrls->toArray()));

Route::get('{short_url:short_code}', RedirectController::class)
    ->name('redirect');
