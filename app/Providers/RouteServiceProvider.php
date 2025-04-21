<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        parent::boot();

        Route::model('user', User::class);
    
        // Force JSON response for API routes
        if ($this->app->runningInConsole()) {
            return response()->json(['message' => 'Console Mode'], 200);
        }
    }
}
