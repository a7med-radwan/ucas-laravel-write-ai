<?php

namespace App\Providers;

use App\Events\PostViewed;
use App\Listeners\IncrementPostViews;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('APP_CONFIG', function () {
            return config('app');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->is('dashboard/*')) {
            Paginator::useTailwind();
        } else {
            Paginator::defaultView('pagination.custom-tailwind');
        }

        JsonResource::withoutWrapping();

        //Event::listen(PostViewed::class, IncrementPostViews::class);

        Gate::before(function ($user, $ability, $arguments) {
            if (in_array($ability, ['update', 'delete', 'restore', 'forceDelete'])) {
                $target = $arguments[0] ?? null;
                if ($target instanceof \App\Models\User && $user->id === $target->id) {
                    return false;
                }
            }

            if ($user->type === 'super-admin' || $user->hasRole('Super Admin')) {
                return true;
            }
        });

        foreach (config('abilities') as $key => $value) {
            Gate::define($key, function ($user) use ($key): bool {
                foreach ($user->roles as $role) {
                    if (in_array($key, $role->abilities)) {
                        return true;
                    }
                }
                return false;
            });
        }
    }
}