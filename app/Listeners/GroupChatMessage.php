<?php

namespace App\Listeners;

use App\Events\GroupChat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GroupChatMessage
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
     * @param  GroupChat  $event
     * @return void
     */
    public function handle(GroupChat $event)
    {
        return $event;
    }
}