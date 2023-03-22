<?php

namespace App\Services;

use GuzzleHttp\Client;

class GuzzleHttp implements HttpInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get(string $url): string
    {
        return $this->client->get($url)->getBody();
    }
}
