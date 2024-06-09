<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Declare a public property to hold the OTP value

    /**
     * Create a new message instance.
     *
     * @param string $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp; // Assign the OTP value to the property
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test Email')
            ->view('emails.otp');
    }
}
