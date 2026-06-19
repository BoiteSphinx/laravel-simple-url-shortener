<?php

namespace App\Actions\Links;

use App\Models\ShortUrl;

class UpdateShortUrl
{
    public function handle(ShortUrl $shortUrl, string $destination): ShortUrl
    {
        $shortUrl->update([
            'original_url' => $destination,
        ]);

        return $shortUrl->fresh();
    }
}
