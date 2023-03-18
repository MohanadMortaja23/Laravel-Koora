<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalTeam extends Model
{

    

    use HasFactory;
    protected $guarded = [];
    
    public function scopeActive()
    {
        return $this->where('status' , 1);
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function Conversation()
    {
        return $this->morphOne(Conversation::class , 'team');
    }


    public static function BootHasResturantID()
    {
        static::creating(function ($model){
            $model->Conversation()->create([
                'name'=> $model->name ,
            ]) ;
        });
    }


}
