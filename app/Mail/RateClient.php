<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RateClient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $mensaje;
 
    public function __construct($mensaje)
    {
        $this->mensaje =$mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(!empty($this->mensaje['a_file'])){

            $email=$this->subject( $this->mensaje['subject'])->from($this->mensaje['user']->email);
            $email->attach('cotizaciones/'.$this->mensaje['a_file']);
            $email->view('mails.rate_client');
            return $email;
        }else{
            
    
            return $this->subject( $this->mensaje['subject'])->view('mails.rate_client');


        }
    }
}
