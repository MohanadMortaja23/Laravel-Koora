<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'image' => $this->image_path,
            'user' => [
                'id' =>$this->User->id ?? 1000000,
                'name' =>$this->User->name ?? 'مستخدم كورة' ,
                'image' =>$this->User->image_path ?? asset('imgs/avatar.png'),
            ],  
            
        ];
    }
}
