<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $with = ['User'];

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Conversation()
    {
        return $this->belongsTo(Conversation::class , 'conversation_id');
    }
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

}
