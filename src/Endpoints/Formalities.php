<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\HasAttachments;
use GuichetUnique\Traits\REST;

final class Formalities extends Endpoint
{
    use REST;
    use HasAttachments;

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
}