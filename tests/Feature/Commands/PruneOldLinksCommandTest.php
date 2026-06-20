<?php

use App\Console\Commands\PruneOldLinksCommand;
use App\Mail\ExpiredLinksSummary;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


test('expired links are deleted and users notified', function () {
    Mail::fake();

    $user = User::factory()->create();

    $link = ShortUrl::factory()->for($user)->create(['last_visited_at' => now()->subDays(31)]);

    $this->artisan(PruneOldLinksCommand::class)->assertSuccessful();

    Mail::assertSent(ExpiredLinksSummary::class);

    $this->assertModelMissing($link);
});
