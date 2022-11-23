<?php

namespace GuichetUnique;

use GuichetUnique\Endpoints\Attachments;
use GuichetUnique\Endpoints\RegularizationRequests;
use GuichetUnique\HttpClient;
use GuichetUnique\Endpoints\Endpoint;
use GuichetUnique\Endpoints\Formalities;
use GuichetUnique\Endpoints\FormalityDrafts;
use GuichetUnique\Endpoints\Signatures;
use GuzzleHttp\Client;

final class Sdk
{
    private HttpClient $client;

    private $sandboxMode = false;

    public function __construct(string $email, string $password, bool $sandboxMode = false, $httpHandler = null)
    {
        $this->sandboxMode = $sandboxMode;

        $this->client = new HttpClient([
            'base_uri' => $this->getApiBasePath(),
            'headers' => [
                'Authorization' => "Bearer {$this->attempt($email, $password)}",
                'Accept' => 'application/json',
            ],
            'handler' => $httpHandler,
        ]);
    }

    private function attempt(string $email, string $password): ?string
    {
        $bearerToken = null;

        $client = new Client();
        $response = $client->post("{$this->getAuthBasePath()}/user/login/sso", [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'username' => $email,
                'password' => $password,
            ],
        ]);

        $headers = $response->getHeaders();

        foreach ($headers as $key => $header) {
            if (strtolower($key) === 'set-cookie') {
                $bearerToken = $this->extractBearerToken($header[0]);
            }
        }

        return $bearerToken;
    }

    public function isSandboxMode(): bool
    {
        return $this->sandboxMode;
    }

    public function formalities(): Formalities
    {
        return new Formalities($this->client);
    }

    public function formalityDrafts(): FormalityDrafts
    {
        return new FormalityDrafts($this->client);
    }

    public function signatures(): Signatures
    {
        return new Signatures($this->client);
    }

    public function regularizationRequests(): RegularizationRequests
    {
        return new RegularizationRequests($this->client);
    }

    public function attachments(): Attachments
    {
        return new Attachments($this->client);
    }
    
    private function getApiBasePath(): string
    {
        return $this->isSandboxMode() ? Endpoint::API_BASE_PATHS['sandbox'] : Endpoint::API_BASE_PATHS['production'];
    }

    private function getAuthBasePath(): string
    {
        return $this->isSandboxMode() ? Endpoint::AUTH_BASE_PATHS['sandbox'] : Endpoint::AUTH_BASE_PATHS['production'];
    }

    private function extractBearerToken(string $cookies = ''): ?string
    {
        $cookies = explode(';', $cookies);
        $bearerTokenCookie = $cookies[0] ?? '';

        return str_replace('BEARER=', '', $bearerTokenCookie);
    }
}
