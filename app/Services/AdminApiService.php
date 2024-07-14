<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

class AdminApiService
{

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getProducts()
    {
        $response = $this->client->request('GET', 'products');

        return $this->responseHandler($response);
    }

    public function buyProducts(array $products)
    {
        $response = $this->client->request('POST', 'orders', [
            'json' => [
                'products' => $products,
            ]
        ]);

        return $this->responseHandler($response);
    }

    public function getOrders()
    {
        $response = $this->client->request('GET', 'orders');

        return $this->responseHandler($response);
    }

    public function sendRequest(string $method, string $url, array $options = [])
    {
        $response = $this->client->request($method, $url, [
            'json' => [
                'params' => $options
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
