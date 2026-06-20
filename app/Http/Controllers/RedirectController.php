<?php

namespace App\Http\Controllers;

use App\Actions\Links\ConsumeShortUrl;
use App\Models\ShortUrl;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShortUrl $shortUrl, ConsumeShortUrl $action): RedirectResponse
    {
        $action->handle($shortUrl);

        return redirect()->away(
            $shortUrl->original_url
        );
    }
}
