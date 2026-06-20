<?php

namespace App\Console\Commands;

use App\Actions\Links\CleanupOldLinks;
use App\Mail\ExpiredLinksSummary;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

#[Signature('links:prune')]
#[Description('Prunes links older than 30 days.')]
class PruneOldLinksCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedLinks = app(CleanupOldLinks::class)->handle();

        $deletedLinks
            ->groupBy('user_id')
            ->each(function ($links) {
                $user = User::find($links->first()->user_id);

                Mail::to($user)->send(new ExpiredLinksSummary($links->all()));
            });

        $count = $deletedLinks->count();

        $this->info("{$count} liens supprimés.");

        return self::SUCCESS;
    }
}
