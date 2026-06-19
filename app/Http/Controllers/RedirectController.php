<?php

namespace App\Http\Controllers;

use App\Actions\Links\ConsumeShortUrl;
use App\Models\ShortUrl;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShortUrl $shortUrl, ConsumeShortUrl $action)
    {
        $action->handle($shortUrl);

        return redirect()->away(
            $shortUrl->original_url
        );
    }
}
