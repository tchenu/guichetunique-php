<?php

namespace GuichetUnique;

use GuzzleHttp\Client;

final class HttpClient extends Client
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
}