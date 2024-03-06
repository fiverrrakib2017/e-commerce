<?php

namespace App\Listeners;

use App\Events\ParameterSave;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ParameterSave
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
    public function handle(ParameterSave $event): void
    {
        //
    }
}
