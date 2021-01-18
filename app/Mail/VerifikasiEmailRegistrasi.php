<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifikasiEmailRegistrasi extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_verification_token)
    {
        $this->email_verification_token = $email_verification_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('official.indahjaya@gmail.com')
            ->view('email')
            ->with(
            [
                'email_verification_token' => $this->email_verification_token
            ]);
    }
} 