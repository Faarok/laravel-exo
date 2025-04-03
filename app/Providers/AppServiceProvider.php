<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Listeners\ContactEventSubscriber;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(app()->environment('production'))
            Vite::useBuildDirectory(public_path('build'));

        Paginator::defaultView('components.pagination');
        Paginator::defaultSimpleView('components.pagination');

        // Event::subscribe(ContactEventSubscriber::class);
    }
}