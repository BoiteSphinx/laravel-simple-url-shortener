<?php

use App\Actions\Links\DeleteShortUrl;
use App\Models\ShortUrl;

test('short_url is soft deleted', function () {
    $url = ShortUrl::factory()->create();

    app(DeleteShortUrl::class)->handle($url);

    $this->assertSoftDeleted('short_urls', ['id' => $url->id]);
});

test('deleted links are not accessible', function () {
    $link = ShortUrl::factory()->create([
        'short_code' => 'abc123',
    ]);

    $link->delete();

    $this->get('/abc123')
        ->assertNotFound();
});
