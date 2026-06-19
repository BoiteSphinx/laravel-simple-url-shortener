<?php

use App\Actions\Links\UpdateShortUrl;
use App\Models\ShortUrl;

test('short_url can be updated', function () {
    $url = ShortUrl::factory()->create([
        'original_url' => 'https://old.com',
    ]);

    $updated = app(UpdateShortUrl::class)
        ->handle(
            $url,
            'https://new.com'
        );

    expect($updated->original_url)->toBe('https://new.com');
});
