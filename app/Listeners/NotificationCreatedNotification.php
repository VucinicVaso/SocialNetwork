<?php

namespace App\Listeners;

use App\Events\NotificationCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

//models
use App\Notification;

class NotificationCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationCreated  $event
     * @return void
     */
    public function handle(NotificationCreated $event)
    {
        Notification::create([                                
            'notification_from' => auth()->user()->id,
            'user_id'           => $event->post->user_id,
            'target'            => $event->post->id,
            'type'              => $event->type,
            'status'            => 0
        ]);
    }
}
