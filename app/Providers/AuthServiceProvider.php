<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        foreach(Permission::get() as $p) {
            Gate::define($p->code, function($user) use ($p) {
                return $user->role->permissions()->where('code', $p->code)->exists();
            });
        }

    }
}
