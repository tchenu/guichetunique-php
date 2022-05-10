<?php

namespace GuichetUnique\Endpoints;

use GuichetUnique\Traits\REST;

class FormalityDrafts extends Endpoint
{
    use REST;

    public function resource(): string
    {
        return 'formality_drafts';
    }

    public function addAttachment(string $resourceId, array $data)
    {
        $response = $this->client->post("{$this->resource()}/{$resourceId}/attachments", [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function destroyAttachment(string $formalityDraftId, string $attachmentId)
    {
        $response = $this->client->delete("{$this->resource()}/{$formalityDraftId}/attachments/{$attachmentId}");

        return json_decode($response->getBody()->getContents(), true);
    }

    public function validate(string $formalityDraftId)
    {
        $response = $this->client->get("{$this->resource()}/{$formalityDraftId}/validators");

        return json_decode($response->getBody()->getContents(), true);
    }
}