<?php

namespace App\Actions\Links;

use App\Models\ShortUrl;
use Illuminate\Support\Collection;

class CleanupOldLinks
{
    public function handle(): Collection
    {
        $limit = now()->subDays(
            config('links.inactive_days')
        );

        $links = ShortUrl::query()
            ->whereNotNull('last_visited_at')
            ->where('last_visited_at', '<', $limit)
            ->get();

        foreach ($links as $link) {
            $link->forceDelete();
        }

        return $links;
    }
}
