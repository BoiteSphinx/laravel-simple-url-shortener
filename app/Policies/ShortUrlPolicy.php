<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShortUrlPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ShortUrl $shortUrl): bool
    {
        return $shortUrl->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ShortUrl $shortUrl): bool
    {
        return $shortUrl->user_id === $user->id;
    }
}
