<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function send()
    {
        
 
        Mail::to("receiver@example.com")->send(new DemoEmail());
        return "mensaje enviado";
    }
}