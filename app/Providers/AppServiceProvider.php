<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        URL::forceRootUrl(Config::get('app.url'));

        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'spbstu',
            function ($app) use ($socialite) {
                $config = $app['config']['services.spbstu'];
                return $socialite->buildProvider(SpbstuProvider::class, $config);
            }
        );

        if (env('FORCE_HTTPS',false)) {
            URL::forceScheme('https');
        }
    }
}
