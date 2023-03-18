<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function Vote()
    {
        return $this->hasMany(Vote::class , 'option_id' , 'id');
    }
    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

}
