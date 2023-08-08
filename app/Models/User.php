<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

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
        'password' => 'hashed',
    ];

    function projects() {
        return $this->hasMany(Project::class);
    }

    function proposals() {
        return $this->hasMany(Proposal::class);
    }

    function jobs() {
        return $this->hasMany(Job::class);
    }

    function reviews() {
        return $this->hasMany(Review::class);
    }

    function send_messages() {
        return $this->hasMany(Message::class, 'sender_id');
    }

    function received_messages() {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
