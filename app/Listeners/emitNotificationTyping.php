<?php

namespace App\Listeners;

use App\Events\typingMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class emitNotificationTyping
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
    public function handle(typingMessage $event): void
    {
        
    }
}
