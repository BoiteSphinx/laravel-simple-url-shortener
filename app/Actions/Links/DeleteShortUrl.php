<?php

namespace App\Actions\Links;

use App\Models\ShortUrl;

class DeleteShortUrl
{
    public function handle(ShortUrl $shortUrl): void
    {
        $shortUrl->delete();
    }
}
