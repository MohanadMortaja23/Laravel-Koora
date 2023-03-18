<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['Comments'];

    public function scopeActive()
    {
        return $this->where('status' , 1);
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function Options()
    {
        return $this->hasMany(Option::class , 'post_id' , 'id');
    }


    public function Vote()
    {
        return $this->hasManyThrough(Vote::class , Option::class);
    }


    public function Reactions()
    {
        return $this->hasMany(PostReaction::class , 'post_id' , 'id');
    }


    

    public function Comments()
    {
        return $this->morphMany(Comment::class , 'post'  , 'post_type' , 'post_id' );
    }
}
