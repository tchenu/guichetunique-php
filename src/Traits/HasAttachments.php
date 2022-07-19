<?php

namespace GuichetUnique\Traits;

trait HasAttachments
{
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

    public function attachments(string $resourceId)
    {
        $response = $this->client->get("{$this->resource()}/{$resourceId}/attachments");

        return json_decode($response->getBody()->getContents(), true);
    }
}