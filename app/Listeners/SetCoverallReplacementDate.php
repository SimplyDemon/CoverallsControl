<?php

namespace App\Listeners;

use App\Events\CoverallSave;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetCoverallReplacementDate
{

    /**
     * Handle the event.
     */
    public function handle(CoverallSave $event): void
    {
        $coveralls = $event->coveralls;
        foreach ($coveralls as $coverall) {

            if (!$coverall->date_issuance && !$coverall->date_replacement && $coverall->employer_id) {
                $coverall->update([
                    'status' => 'issued',
                    'date_issuance' => now(),
                    'date_replacement' => now()->addMonths($coverall->coverallType->term_life),
                ]);
            }
        }
    }
}
