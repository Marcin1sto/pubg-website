<?php

namespace App\Services;

use stdClass;

class PubgConnector
{
    /**
     * @var null
     */
    private $response;

    public function __construct()
    {
        $this->response = null;
    }

    public function connect(string $prefix): PubgConnector
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, env('API_PUBG_URL') . $prefix);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . env('API_PUBG_TOKEN'), 'Accept: application/vnd.api+json'));
        $this->response = json_decode(curl_exec($request));

        return $this;
    }

    public function getData(): stdClass
    {
        return $this->response;
    }
}
