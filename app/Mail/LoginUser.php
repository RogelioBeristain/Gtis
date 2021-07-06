<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginUser extends Mailable
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

            $email=$this->subject( $this->mensaje['subject'].' de '.$this->mensaje['client']->name );
             

            return $email;
        }else{
            //  Storage::prepend('cotizaciones/'.$this->mensaje['client']->name.'/messages.log', $this->mensaje['bodyMessage'].'\n');
            
            return $this->subject( $this->mensaje['subject'].' de '.$this->mensaje['client']->name )
        
          ->view('mails.client_new_register');


        }
    }
}
