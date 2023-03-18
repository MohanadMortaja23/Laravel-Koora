<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralTeam extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded = [];
    
    public function scopeActive()
    {
        return $this->where('status' , 1);
    }
    
    public function Conversation()
    {
        return $this->morphOne(Conversation::class , 'team');
    }

   

}
