<?php

namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class WeatherApiService
{

    const TIME_PERIOD = 'daily';

    const WEATHER_OPTIONS = 'weather_code,apparent_temperature_max,apparent_temperature_min';

    const TIME_FORMAT = 'iso8601';

    const TIME_ZONE = 'Europe/Moscow';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getWeeklyWeather(string $city)
    {
        $geocodingApiService = app(GeocodingApiService::class);
        $geolocation = $geocodingApiService->getGeolocation($city)->first();

        $response = $this->client->request('GET', 'forecast', [
            'query' => [
                'latitude' => $geolocation['latitude'],
                'longitude' => $geolocation['longitude'],
                self::TIME_PERIOD => self::WEATHER_OPTIONS,
                'timeformat' => self::TIME_FORMAT,
                'timezone' => self::TIME_ZONE,
            ]
        ]);

        return $this->responseHandler($response);
    }

    protected function responseHandler(ResponseInterface $response)
    {
        switch ($response->getStatusCode()) {
            case 200:
                return json_decode($response->getBody(), true);
        }
    }

}
