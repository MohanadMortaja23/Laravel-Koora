<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\TeamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
        
        
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
        ];
    }
}
