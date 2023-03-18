<?php

namespace App\Http\Resources;

use App\Models\RealReaction;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RealResource extends JsonResource
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
            'id'=> $this->id ,
            'video'=> $this->video_path ,
            'reaction_counts'=> $this->Reactions->count(),
            'comments_count'=> $this->Comments->count(),
            'user' => [
                'id' => $this->user_id,
                'name' => $this->User->name ?? 'Amr',
                'image' => $this->User->image_path ?? asset('imgs/avatar.png') ,
            ],
            'is_like'=> RealReaction::where('real_id' , $this->id)->where('user_id' , Auth::guard('sanctum')->id())->exists(),
           
        ];
    }
}
