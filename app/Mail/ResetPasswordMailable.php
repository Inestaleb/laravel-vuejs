<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $token;   // this token that Controller make it to send Email
    
    
    public function __construct($token, $email)
    {
        $this->email = $email;
        $this->token = $token;
       
    }
   
    
    public function build()
    {
        return $this->markdown('Email.passwordReset')->with([ 
            'email' => $this->email,
            'token' => $this->token
            
        ]);
    }
}
