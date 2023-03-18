<?php

namespace App\Http\Resources;

use App\Models\PostReaction;
use App\Models\Reaction;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
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
            'details'=> $this->details ,
            'owner'=> $this->owner ,
            'link'=> $this->link ,
            'image'=>$this->image ?  $this->image_path : null ,
            'options'=> OptionResource::collection($this->Options) ,
            'comments_count'=>  $this->Comments->count() ,
            'comment'=> new CommentResource($this->Comments()->latest()->first()) ,
            'reaction_counts'=> $this->Reactions->count(),
            'is_like'=> PostReaction::where('post_id' , $this->id)->where('user_id' , Auth::guard('sanctum')->id())->exists(),
            // 'reactions'=> ReactionResource::collection($this->Reactions) ,
        ];
    }
}
