<?php

namespace GuichetUnique\Endpoints;

class Signatures extends Endpoint
{
    public function resource(): string
    {
        return 'signatures';
    }

    public function sign(string $formalityId): string
    {
        $response = $this->client->post("{$this->resource()}", [
            'json' => [
                'formality' => "api/formalities/{$formalityId}",
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function advancedSign(string $formalityId): string
    {
        throw new \Exception('Advanced sign is not implemented yet');
    }
}