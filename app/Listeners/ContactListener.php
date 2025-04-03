<?php

namespace App\Listeners;

use App\Mail\PropertyContact;
use App\Events\ContactRequestEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactListener implements ShouldQueue
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
    public function handle(ContactRequestEvent $event): void
    {
        Mail::to('ssamson@cabinet-bedin-immobilier.com')->send(new PropertyContact($event->property, $event->data));
    }
}
