<?php

namespace InsologyStudio\FattureInCloud\Api;
use InsologyStudio\FattureInCloud\Factory\ApiFactory;
use Illuminate\Support\Facades\Http;

abstract class Api implements ApiFactory 
{   

    private array $errors = [];
    private array $params = [];
    private string $apiUid;
    private string $apiKey;

    /**
     * Auth constructor.
     *
     * @param string $apiUid
     * @param string $apiKey
     *
     * @throws Exception
     */
    public function __construct()
    {   
        $this->errors = config('fatture-in-cloud.errors');
        $this->apiUid  = config('fatture-in-cloud.api_uid');
        $this->apiKey = config('fatture-in-cloud.api_key');
        if (empty($this->apiUid) || empty($this->apiKey)) {
            throw new \Exception('You need to pass apiUid and apiKey');
        }
        $this->params = [
            'api_uid' => $this->apiUid,
            'api_key' => $this->apiKey,
        ];
    }

    /**
     * Exec API call.
     *
     * @param string $url
     * @param array  $data
     * @param string $method
     *
     * @return array|mixed
     */
    private function call($url = '', $data = [], $method = 'post')
    {
        try {
            $url = config('fatture-in-cloud.endpoint').$url;

            $response = Http::withHeaders([
                'Content-type' => 'text/json',
            ])->{$method}($url, $data);
            return $response->json();
            
        } catch (\Exception $e) {
            return (object) [
                'error'   => $e->getMessage(),
                'code'    => $e->getCode(),
                'success' => false,
            ];
        }
    }

    /**
     * POST call.
     *
     * @param $path
     * @param array $data
     *
     * @return mixed|string
     */
    public function post(string $path, array $data = []): array
    {
        $params = array_merge($this->params, $data);

        return $this->call($path, $params, 'POST');
    }
}