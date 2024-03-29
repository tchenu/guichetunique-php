<?php

namespace GuichetUnique\Traits;

trait REST
{
    public function all(array $queryParams = [])
    {
        $response = $this->client->get("{$this->resource()}", [
            'headers' => ['Accept-Encoding' => 'application/json'],
            'query' => $queryParams,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function get(string $resourceId): ?array
    {
        $response = $this->client->get("{$this->resource()}/{$resourceId}");

        return json_decode((string) $response->getBody(), true);
    }

    public function create(array $data): ?array
    {
        $response = $this->client->post("{$this->resource()}", [
            'json' => $data,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function update(array $data, string $resourceId): ?array
    {
        $response = $this->client->put("{$this->resource()}/{$resourceId}", [
            'json' => $data,
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function destroy(string $resourceId): void
    {
        $this->client->delete("{$this->resource()}/{$resourceId}");
    }
    
    public function resource(): string
    {
        return '';
    }
}