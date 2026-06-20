<?php

use App\Models\ShortUrl;
use App\Models\User;

describe('as a guest', function () {
    test('cannot access index page', function () {
        $this->actingAsGuest()
            ->get(route('links.index'))
            ->assertRedirect(route('login'));
    });
});

describe('as an authenticated user', function () {
    test('index page can be rendered', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('links.index'))
            ->assertOk();
    });

    test('create page can be rendered', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('links.create'))
            ->assertOk();
    });

    test('can create a link', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('links.store'), [
                'original_url' => 'https://google.com'
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('short_urls', [
            'user_id' => $user->id,
            'original_url' => 'https://google.com'
        ]);
    });

    test('url must be valid', function () {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('links.store'), [
                'original-url' => 'not a url'
            ])
            ->assertInvalid();
    });

    test('owner can update link', function () {
        $user = User::factory()->create();

        $link = ShortUrl::factory()
            ->for($user)
            ->create();

        $this->actingAs($user)
            ->put(route('links.update', $link), [
                'original_url' => 'https://google.com',
            ])
            ->assertRedirect();

        expect(
            $link->fresh()->original_url
        )->toBe('https://google.com');
    });

    test('owner can delete link', function () {
        $user = User::factory()->create();

        $link = ShortUrl::factory()
            ->for($user)
            ->create();

        $this->actingAs($user)
            ->delete(route('links.destroy', $link))
            ->assertRedirect();

        $this->assertSoftDeleted(
            'short_urls',
            ['id' => $link->id]
        );
    });

    test('user cannot edit another user link', function () {
        $owner = User::factory()->create();

        $someoneElse = User::factory()->create();

        $link = ShortUrl::factory()
            ->for($owner)
            ->create();

        $this->actingAs($someoneElse)
            ->put(route('links.update', $link), [
                'original_url' => 'https://something.com',
            ])
            ->assertForbidden();
    });
});
