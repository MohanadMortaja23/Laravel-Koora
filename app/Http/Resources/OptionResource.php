<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $vote =  $this->vote()->count() ;
        if($vote > 0)
        {
            $percantage =  $vote  /  Post::find($this->post_id)->Vote->count()  * 100 ;

        }else{
            $percantage = 0 ;
        }

        return [
            'id'=> $this->id ,
            'image'=> $this->image_path ,
            'vote'=> $this->vote()->count(),
            'percentage'=>  round($percantage ,1) .'%'
        ];
    }
}
