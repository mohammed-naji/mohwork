<?php

namespace App\Models;

use App\Traits\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory, SoftDeletes, Scope;

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

    function scopeOpen(Builder $query) {
        $query->where('status', 'open');
    }
}
