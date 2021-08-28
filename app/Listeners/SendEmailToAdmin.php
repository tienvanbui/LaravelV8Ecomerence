<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SendEmailToAdmin implements ShouldQueue
{  
    use InteractsWithQueue, Queueable, SerializesModels;
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
    public function handle($event)
    {
        Mail::to($event->to_email)->send(new ContactMail($event->user, $event->message));
    }
}
