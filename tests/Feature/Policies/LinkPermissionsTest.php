<?php

use App\Models\ShortUrl;
use App\Models\User;

test('user cannot edit another user url', function () {
    $owner = User::factory()->create();

    $someoneElse = User::factory()->create();

    $url = ShortUrl::factory()
        ->for($owner)
        ->create();

    $this->actingAs($someoneElse)
        ->put(route('links.update', $url), [
            'original_url' => 'https://something.com',
        ])
        ->assertForbidden();
});

test('user cannot delete another user url', function () {
    $owner = User::factory()->create();

    $someoneElse = User::factory()->create();

    $url = ShortUrl::factory()
        ->for($owner)
        ->create();

    $this->actingAs($someoneElse)
        ->delete(route('links.destroy', $url))
        ->assertForbidden();
});
