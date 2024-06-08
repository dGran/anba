<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TableWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Model $table;

    public string $type;

    public string $detail;

    public string $detailBefore;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $table, string $type, string $detail = null, string $detailBefore = null)
    {
        $this->table = $table;
        $this->type = $type;
        $this->detail = $detail;
        $this->detailBefore = $detailBefore;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): Channel|PrivateChannel|array
    {
        return new PrivateChannel('channel-name');
    }
}
