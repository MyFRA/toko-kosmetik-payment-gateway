<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;
use Crypt;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->user = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $encryptedEmail = Crypt::encrypt($this->user->email);

        // ex: domain.com/verify?token=xxxx
        $link = route('customer.verify', ['token' => $encryptedEmail]);

        return $this->subject('Verify Your Email Address')
            ->with('link', $link)
            ->view('auth.customer.email-signup');
    }
}
