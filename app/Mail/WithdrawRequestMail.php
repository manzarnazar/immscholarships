<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class WithdrawRequestMail extends Mailable
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->view('mail.WithdrawRequestMail') // Create a Blade view for OTP email
                    ->with([
                        'amount' => $this->otp,
                    ]);
    }
}

?>