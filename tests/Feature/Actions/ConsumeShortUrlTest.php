<?php

use App\Actions\Links\ConsumeShortUrl;
use App\Models\ShortUrl;

test('visit count is incremented', function () {
    $url = ShortUrl::factory()->create(['visits' => 0]);

    app(ConsumeShortUrl::class)
        ->handle($url);

    expect($url->fresh()->visits)
        ->toBe(1);
});
