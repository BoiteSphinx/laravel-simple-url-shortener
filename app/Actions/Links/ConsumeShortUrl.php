<?php

namespace App\Actions\Links;

use App\Models\ShortUrl;

class ConsumeShortUrl
{
    public function handle(ShortUrl $url): void
    {
        $url->increment('visits');

        $url->touch(['last_visited_at', 'updated_at']);
    }
}
