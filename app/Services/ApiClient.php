<?php namespace App\Services;

use Config\Services;

class ApiClient
{
    private $client; private string $base;

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'timeout' => 20,
            'http_errors' => false,
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);
        $this->base = rtrim(getenv('backend.api') ?: 'http://localhost:8899/api', '/');
    }

    public function get(string $path, array $query = []): array
    {
        $res = $this->client->get($this->base.$path, ['query' => $query]);
        return $this->decode($res->getStatusCode(), (string)$res->getBody());
    }

    public function post(string $path, array $payload = []): array
    {
        $res = $this->client->post($this->base.$path, ['body' => json_encode($payload)]);
        return $this->decode($res->getStatusCode(), (string)$res->getBody());
    }

    public function patch(string $path, array $payload = []): array
    {
        $res = $this->client->request('PATCH', $this->base.$path, ['body' => json_encode($payload)]);
        return $this->decode($res->getStatusCode(), (string)$res->getBody());
    }

    private function decode(int $code, string $body): array
    {
        $json = json_decode($body, true);
        return ['code' => $code, 'body' => $json ?? $body];
    }
}
