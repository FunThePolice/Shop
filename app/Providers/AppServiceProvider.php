<?php

namespace App\Providers;

use App\Services\AdminApiService;
use App\Services\GeocodingApiService;
use App\Services\WeatherApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminApiService::class, function () {
            return new AdminApiService(
                new Client(['base_uri' => 'http://first-attempt.local/api/'])
            );
        });

        $this->app->bind(WeatherApiService::class, function () {
            return new WeatherApiService(
                new Client(['base_uri' => 'https://api.open-meteo.com/v1/'])
            );
        });

        $this->app->bind(GeocodingApiService::class, function () {
            return new GeocodingApiService(
                new Client(['base_uri' => 'https://api.api-ninjas.com/v1/'])
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
