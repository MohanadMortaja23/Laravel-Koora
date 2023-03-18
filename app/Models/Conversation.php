<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Messages()
    {
        return $this->hasMany(Message::class);
    }
    public function User()
    {
        return $this->hasMany(User::class);
    } 

    public function Local()
    {
        return $this->belongsTo(LocalTeam::class);
    }

    public function Global()
    {
        return $this->belongsTo(GlobalTeam::class , 'global_id' , 'id' , 'id');
    }

    public function National()
    {
        return $this->belongsTo(NationalTeam::class);
    }

}
