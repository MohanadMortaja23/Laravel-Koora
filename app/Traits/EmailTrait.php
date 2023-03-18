<?php 

namespace App\Traits ;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

trait EmailTrait {


    public function sendEmailVerificationNotification($email)
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to($email)->send(new \App\Mail\MyTestMail($details));
    }
  

}