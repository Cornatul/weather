<?php

namespace Cornatul\Weather;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class WeatherProvider extends ServiceProvider
{
    //http://mytracker/issue/MYPROJECT-110

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/weather.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'weather');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/../config/weather.php', 'weather');
        $this->publishes([
            __DIR__ . '/../config/weather.php' => config_path('weather.php'),
        ], 'weather-config');
    }

    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(IpGeolocationContract::class, IpGeolocation::class);
    }
}
