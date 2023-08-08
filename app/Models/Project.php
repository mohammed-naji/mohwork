<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    function skills() {
        return $this->belongsToMany(Skill::class);
    }

    function proposals() {
        return $this->hasMany(Proposal::class);
    }

    function job() {
        return $this->hasOne(Job::class);
    }
}
