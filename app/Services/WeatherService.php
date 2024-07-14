<?php

namespace App\Services;

class WeatherService
{

    public static function wrap(array $data)
    {
       $collection = collect($data['daily']);

        return array_map(null,
           $collection['time'],
           $collection['weather_code'],
           $collection['apparent_temperature_max'],
           $collection['apparent_temperature_min'],
       );
    }
}
