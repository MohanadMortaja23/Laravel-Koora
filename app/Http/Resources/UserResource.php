<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\TeamResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BlockResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->National)
        {
            $teams = [
                new TeamResource($this->Local->setAttribute('type', 'local')), 
                new TeamResource($this->Global->setAttribute('type', 'global')),
                new TeamResource($this->National->setAttribute('type', 'national'))
            ];
        }else{
            $teams = [];
        }
        
        
        $first_name =null;
          $last_name =null;
        
       if($this->name)
       {
             $fullname= $this->name;
        $name=explode(" ",$fullname);
        $first_name = $name[0];//give you firstname which is Sachin
        $last_name = $name[1]; //will print last name which is tendulkar in our case.
       }
     


        return [
            'id' => $this->id,
            'image' => $this->image_path,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $this->email,
            'desc' => $this->desc,
            'is_first' => !$this->email_verified_at ? true : false,
            'points' => $this->points,
            'teams' => $teams,
            'token' => $this->token,
            'device_token' => $this->device_token,
            'bloecked_user'=>  BlockResource::collection($this->Blocked),
        ];
    }
}
