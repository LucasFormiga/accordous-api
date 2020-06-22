<?php

namespace App\Listeners;

use App\Events\CreatedProviderEvent;
use App\Jobs\DispatchActivationMail;
use App\Mail\ActivateProviderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreatedProviderListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(CreatedProviderEvent $event)
    {
        DispatchActivationMail::dispatchNow($event->provider);
    }
}
