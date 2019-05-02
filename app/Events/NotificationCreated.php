<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class NotificationCreated
{
    use Dispatchable, SerializesModels;

    public $post;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($post, $type)
    {
        $this->post = $post;
        $this->type = $type;
    }

}
