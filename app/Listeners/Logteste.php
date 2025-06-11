<?php

namespace App\Listeners;

use App\Events\testeLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class Logteste
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
    public function handle(testeLog $event)
    {
        Log::info("Novo usuario criado",[
            'name'=> $event->name
        ]);
        
    }
}
