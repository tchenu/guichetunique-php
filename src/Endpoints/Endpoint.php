<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\HttpClient;

abstract class Endpoint
{
    protected HttpClient $client;

    public const API_BASE_PATHS = [
        'sandbox' => 'https://guichet-unique-demo.inpi.fr/api/',
        'production' => 'https://guichet-unique.inpi.fr/api/',
    ];

    public const AUTH_BASE_PATHS = [
        'sandbox' => 'https://guichet-unique-demo.inpi.fr/api',
        'production' => 'https://guichet-unique.inpi.fr/api',
    ];

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }
}