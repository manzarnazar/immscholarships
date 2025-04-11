<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OtpMail extends Mailable
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->view('mail.otp') // Create a Blade view for OTP email
                    ->with([
                        'otp' => $this->otp,
                    ]);
    }
}

?>