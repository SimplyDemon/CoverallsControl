<?php

namespace App\Events;

use App\Models\Coverall;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CoverallSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Collection $coveralls;

    /**
     * Create a new event instance.
     */
    public function __construct(Collection $coveralls)
    {
        $this->coveralls = $coveralls;
    }

}
