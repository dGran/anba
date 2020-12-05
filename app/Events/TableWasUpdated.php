<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TableWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;
    public $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($table, $type, $detail = null, $detail_before = null)
    {
        $this->table = $table;
        $this->type = $type;
        $this->detail = $detail;
        $this->detail_before = $detail_before;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
