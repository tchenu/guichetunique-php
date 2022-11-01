<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\REST;

final class Attachments extends Endpoint
{
    use REST;

    public function resource(): string
    {
        return 'attachments';
    }

    public function download(string $resourceId)
    {
        return $this->client->get("{$this->resource()}/{$resourceId}/file")->getBody();
    }
}