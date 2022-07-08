<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\REST;

final class Formalities extends Endpoint
{
    use REST;

    public function resource(): string
    {
        return 'formalities';
    }

    public function validate(string $resourceId)
    {
        $response = $this->client->get("{$this->resource()}/{$resourceId}/validators");

        return json_decode($response->getBody()->getContents(), true);
    }

    public function synthesis(string $resourceId)
    {
        $response = $this->client->get("{$this->resource()}/{$resourceId}/synthesis");

        return $response->getBody()->getContents();
    }

    public function attachments(string $resourceId)
    {
        $response = $this->client->get("{$this->resource()}/{$resourceId}/attachments");

        return json_decode($response->getBody()->getContents(), true);
    }
}