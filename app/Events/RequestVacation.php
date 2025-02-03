<?php

namespace App\Events;

use App\Models\VacationRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestVacation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $content;
    public $target;

    /**
     * Create a new event instance.
     */
    public function __construct($user_id, $content, $target = null)
    {
        $this->user_id = $user_id;
        $this->content = $content;
        $this->target = $target;
    }
}
