<?php

namespace App\Services;

use App\Enums\PlatformEnum;
use stdClass;

class PubgConnector
{
    /**
     * @var null
     */
    private $response;

    private string $platform = 'steam';

    public function __construct()
    {
        $this->response = null;
    }

    public function connect(string $prefix): self
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, env('API_PUBG_URL'). $this->platform . '/' . $prefix);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . env('API_PUBG_TOKEN'), 'Accept: application/vnd.api+json'));

        $this->response = json_decode(curl_exec($request));

        return $this;
    }

    public function getData(): stdClass
    {
        return $this->response;
    }

    public function connectFalse(): bool
    {
        if (isset($this->response->errors)) {
            return true;
        }

        return is_null($this?->response);
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): void
    {
        if (!in_array($platform, PlatformEnum::toArray())) {
            throw new \InvalidArgumentException('Invalid platform');
        }

        $this->platform = $platform;
    }
}
