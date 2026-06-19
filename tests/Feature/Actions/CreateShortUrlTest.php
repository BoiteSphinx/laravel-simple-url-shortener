<?php

use App\Actions\Links\CreateShortUrl;
use App\Models\User;

test('short_url can be created', function () {
    $user = User::factory()->create();

    $action = app(CreateShortUrl::class);

    $link = $action->handle($user, 'https://google.com');

    expect($link->exists)->toBeTrue();
    expect($link->user_id)->toBe($user->id);
    expect($link->short_code)->not->toBeEmpty();
});
