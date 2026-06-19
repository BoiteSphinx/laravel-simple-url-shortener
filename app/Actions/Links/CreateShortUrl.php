<?php

namespace App\Actions\Links;

use App\Models\ShortUrl;
use App\Models\User;
use App\Services\ShortCodeGenerator;
use Illuminate\Container\Attributes\CurrentUser;

class CreateShortUrl
{
    public function __construct(
        private ShortCodeGenerator $generator
    ) {}

    public function handle(#[CurrentUser] User $user, string $url): ShortUrl
    {
        return ShortUrl::create([
            'user_id' => $user->id,
            'original_url' => $url,
            'short_code' => $this->generator->generate(),
        ]);
    }
}
