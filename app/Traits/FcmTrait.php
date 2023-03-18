<?php 

namespace App\Traits ;

use App\Models\Sector;
use Illuminate\Http\Request;
trait FcmTrait {


    public function sendFcmNotifications($token, $event)
    {

        // FCM Configration
        $SERVER_API_KEY = 'AAAA7wb6uVY:APA91bE7qlDf8Nh-jnWFjoG0TVBI4K_HLQBxJqgjeDlmcnOZuI-d2R6ay8tVdsImNNhC7rcdBjw5l9y3iW6xFoxLXq7RW7_xu8JiOQBWJuzMVzQxdUr5VwC2kEgqBq_FndtYsGH-JiYi';
        $token_1 = $token;
        $data = [
            "registration_ids" => [
                $token_1
            ],


            "notification" => [

                "title" => $event->details,

                "body" => $event->details ,

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

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
      
        
    }

    
   


  

}