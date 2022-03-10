<?php

namespace Bitsika\Resources\Supports;

use GuzzleHttp\Client;
use InvalidArgumentException;

class RequestHandler
{

    /**
     * Base url
     * 
     * @var string
     */
    protected $baseUrl;

    /**
     * Request headers
     * 
     * @var array
     */
    protected $headers = [];

    /**
     * Check if request should be sent as a form
     * 
     * @var boolean
     */
    protected $asForm = false;

    public function __construct(array $clientOptions = [])
    {
        $this->clientOptions = $clientOptions;
    }

    public function makeRequest($method, $url, $params = [])
    {
        if (! in_array($method, HttpMethod::all())) {
            throw new InvalidArgumentException("Invalid method passed `{$method}`");
        }

        if (! empty($this->baseUrl)) {
            $this->clientOptions['base_uri'] = $this->baseUrl;
        }

        // Set request options
        $options = [];
        if (! empty($this->headers)) {
            $options['headers'] = $this->headers;
        }

        if (! empty($params)) {
            if (HttpMethod::GET === $method) {
                $options['query'] = $params;
            }

            if (HttpMethod::POST === $method) {
                if ($this->asForm) {
                    $options['form_params'] = $params;
                }
            }
        }

        return (new Client($this->clientOptions))->request($method, $url, $options);
    }

    public function setBaseUrl(string $url)
    {
        $this->baseUrl = $this->baseUrl . $url;

        return $this;
    }

    public function setHeader(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    public function asForm()
    {
        $this->asForm = true;

        return $this;
    }
}