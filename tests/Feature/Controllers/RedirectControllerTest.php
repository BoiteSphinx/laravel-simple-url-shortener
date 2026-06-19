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
