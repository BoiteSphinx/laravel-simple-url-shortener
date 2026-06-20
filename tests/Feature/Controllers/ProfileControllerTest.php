<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('index page can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('links.index'))
        ->assertOk();
});

test('user can update email', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('user-profile-information.update'), [
            'email' => 'new@example.com',
        ])
        ->assertValid();

    expect(
        $user->fresh()->email
    )->toBe('new@example.com');
});

test('email must be unique', function () {
    User::factory()->create([
        'email' => 'existing@example.com',
    ]);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('user-profile-information.update'), [
            'email' => 'existing@example.com',
        ])
        ->assertInvalid();
});

test('user can update password', function () {
    $user = User::factory()->create([
        'password' => bcrypt('old-password'),
    ]);

    $this->actingAs($user)
        ->put(route('user-password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->assertValid();

    expect(
        Hash::check(
            'new-password',
            $user->fresh()->password
        )
    )->toBeTrue();
});

test('current password must be valid', function () {
    $user = User::factory()->create([
        'password' => bcrypt('old-password'),
    ]);

    $this->actingAs($user)
        ->put(route('user-password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->assertInvalid();
});
