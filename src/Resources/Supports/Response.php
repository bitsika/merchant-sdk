<?php

namespace Bitsika\Resources\Supports;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Bitsika\Resources\Contracts\HttpResponseInterface;

class Response implements HttpResponseInterface
{

    const OK = 'OK';

    /**
     * Guzzle response
     * 
     * @var ResponseInterface
     */
    protected $response;


    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Convert request response to string 
     * 
     * @return array
     */
    public function body(): string
    {
        return $this->response->getBody()->getContents();
    }

    /**
     * Convert request response to array 
     * 
     * @return array
     */
    public function json(): array
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    /**
     * Get status code of request
     * 
     * @return bool
     */
    public function status(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Check if request was successful
     * 
     * @return bool
     */
    public function successful(): bool
    {
        return $this->response->getReasonPhrase() === self::OK;
    }

    /**
     * Check if request failed
     * 
     * @return bool
     */
    public function failed(): bool
    {
        return ! $this->successful();
    }

    /**
     * Get the headers
     * 
     * @return array
     */
    public function headers(): array
    {
        return $this->response->getHeaders();
    }
}