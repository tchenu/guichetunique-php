<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\HasAttachments;
use GuichetUnique\Traits\REST;

class FormalityDrafts extends Endpoint
{
    use REST;
    use HasAttachments;

    public function resource(): string
    {
        return 'formality_drafts';
    }

    public function validate(string $formalityDraftId)
    {
        $response = $this->client->get("{$this->resource()}/{$formalityDraftId}/validators");

        return json_decode($response->getBody()->getContents(), true);
    }
}