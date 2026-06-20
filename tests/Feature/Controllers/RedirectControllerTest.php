<?php

use App\Models\ShortUrl;

test('short url redirects', function () {
    $url = ShortUrl::factory()->create([
        'short_code' => 'abc123',
        'original_url' => 'https://google.com'
    ]);

    $this->get('/abc123')
        ->assertRedirect(
            'https://google.com'
        );
});

test('redirect increments visits and updated last_visited_at', function () {

    $link = ShortUrl::factory()->create([
        'short_code' => 'abc123',
        'visits' => 0,
        'last_visited_at' => null,
    ]);

    $this->get('/abc123');

    expect($link->fresh()->visits)->toBe(1);

    expect($link->fresh()->last_visited_at)->not->toBeNull();
});
