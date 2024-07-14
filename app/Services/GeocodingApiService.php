<?php

namespace App\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GeocodingApiService
{

    const GEO_API_KEY = 'gaa1saKeBVx3408oCskVig==h97wqwM8jzvBIocd';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getGeolocation(string $city)
    {
        $response = $this->client->request('GET', 'geocoding', [
            'headers' => [
                'X-Api-Key' => self::GEO_API_KEY,
            ],
            'query' => [
                'city' => $city,
            ]
        ]);

        return $this->responseHandler($response);
    }

    protected function responseHandler(ResponseInterface $response)
    {
        switch ($response->getStatusCode()) {
            case 200:
                return collect(json_decode($response->getBody(), true));
        }
    }
}
