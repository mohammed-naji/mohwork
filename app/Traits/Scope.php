<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
trait Scope {
    protected static function booted(): void
    {
        static::addGlobalScope('minPrice', function (Builder $builder) {
            $builder->where('price', '>', 20);
        });
    }
}

//
