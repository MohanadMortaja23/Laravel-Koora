<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reals extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getVideoPathAttribute()
    {
        return asset('storage/' . $this->video);
    }

    public function Reactions()
    {
        return $this->hasMany(RealReaction::class , 'real_id' , 'id');
    }
    

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Comments()
    {
        return $this->morphMany(Comment::class , 'post'  , 'post_type' , 'post_id' );
    }

    
}
