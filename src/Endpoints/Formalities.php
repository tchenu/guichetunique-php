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

    public function validate(string $formalityId)
    {
        $response = $this->client->get("{$this->resource()}/{$formalityId}/validators");

        return json_decode($response->getBody()->getContents(), true);
    }
}