<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $lastname)
    {
        $this->email    = $email;
        $this->name     = $name;
        $this->lastname = $lastname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('ConfirmEmailForRegistration', [
            'email'    => $this->email, 
            'name'     => $this->name, 
            'lastname' => $this->lastname
        ]);
    }
}
