<?php

namespace App\Listeners;

use App\Events\RequestVacation;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RequestVacation $event): void
    {
        Notification::create([
            'content' => $event->content,
            'user_id' => $event->user_id,
            'target' => $event->target,
        ]);
    }
}
