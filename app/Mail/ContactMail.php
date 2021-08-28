<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Request;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels,InteractsWithQueue;
    public $user;
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $user,$msg)
    {
        $this->user = $user;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('user123@gmail.com')
                    ->subject('Laravel Ecomerence')
                    ->view('emails.contact.mail')
                    ->with([
                        'name' => $this->user->name,
                        'body' => $this->msg,
                    ]);
    }
}
