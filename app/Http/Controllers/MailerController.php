<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ExampleMail;
use Mail;

class MailerController extends Controller
{
    public function sendEmail()
        {
            Mail::to('novemger.pascua@tup.edu.ph')->send(new ExampleMail());
        }
}