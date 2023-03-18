<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Local()
    {
        return $this->belongsTo(LocalTeam::class);
    }

    public function Global()
    {
        return $this->belongsTo(GlobalTeam::class, 'global_id', 'id', 'id');
    }

    public function National()
    {
        return $this->belongsTo(NationalTeam::class);
    }
    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Blocked()
    {
        return $this->belongsToMany(User::class, UsersBlocked::class , 'user_id' , 'user_bloked');
    }

    public function getImagePathAttribute()
    {

        if ($this->image != null) {
            if ($this->provider_type != null) {
                return   strpos($this->image, 'users/avatars/') !== false ?  asset('storage/' . $this->image) : $this->image;
            } else
                return asset('storage/' . $this->image);
        } else {
            return asset('imgs/avatar.png');
        }
    }

    public function sendEmailVerificationNotification()
    {
        $details = [
            'title' => 'Mail from KooraZone',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to($this->email)->send(new \App\Mail\MyTestMail($details, $this->id));
    }

    public function hasVerifiedEmail()
    {
        $this->email_verified_at ? true : false;
    }

    public function markEmailAsVerified()
    {
        $this->email_verified_at = Carbon::now();
        $this->save();
    }
}
