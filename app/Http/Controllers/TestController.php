<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Traits\FcmTrait;
use Illuminate\Http\Request;

class TestController extends Controller
{

     public function sendFcm()
    {
        $Post = Post::first();
        
        $users = User::where('device_token' , '!=' , null)->get();
       
        foreach($users as $user)
        {
            $this->sendFcmNotifications($user->device_token , $Post);
        }

       dd('msg send successfully');
        
    }



    public function sendFcmNotifications($token, $event)
    {

        // FCM Configration
        $SERVER_API_KEY = 'AAAAhz9Dy2Q:APA91bEEsjaTIaCVjcVpwHrVbuQgQHYuKM8yjVtQmsY0_cszlWtWt3Ufa_MUHSAAWYowTYJfAhZRxjqOjnw5zZuy775l1CnlSq8doY8zSvXraz3kCoELGPgQhf1uaZpxZO-dv4v99vQk';
        $token_1 = $token;

       
        $data = [
            "registration_ids" => [
                $token_1
            ],


            "notification" => [

                "title" => 'test',

                "body" => 'test' ,

                "sound" => "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        dd($response);
        
    }


}
