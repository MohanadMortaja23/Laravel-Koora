<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GlobalEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message ;
    public $user ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user = null , $message , $image = null)
    {
        $this->message =  
         [
            'message' => $message ,
            'team_id'=> $user->global_id ,
            'image' => asset('storage/'. $image ) ?? null,
            'user' => [
                'id' =>$user->id,
                'name' =>$user->name ,
                'image' =>$user->image_path,
            ],
        ] ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('global-chat');
    }

    public function broadcastAs()
    {
        return 'message';
    }
}
