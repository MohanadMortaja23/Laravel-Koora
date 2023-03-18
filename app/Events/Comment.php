<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Comment  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $comment ;
    public $user ;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user , $comment)
    {
        $this->comment =  
        [
            'post_id' => $comment->post_id ,
           'comment' => $comment->comment ,
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
        return new Channel('chat');
    }

    public function broadcastAs()
    {
        return 'comment';
    }
}
