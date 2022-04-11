<?php 

namespace Bitsika\Resources\Services;

use Bitsika\Resources\Contracts\HttpClientInterface;

class Customer
{
    /**
     * Http client
     * 
     * @var HttpClientInterface
     */
    protected $http;
     
    /**
     * Http response
     * 
     * @var array
     */
    protected $response;

    /**
     * @return void
     */
    public function __construct(HttpClientInterface $http)
    {
        $this->http = $http;
    }

    /**
     * Search for a user
     * 
     * @param array $params filters
     * 
     * @return array
     */
    public function search($username) : array
    {
        $url = "customers/search";

        $params['username'] = $username;
        
        $this->response = $this->http->get($url, $params);
        return $this->response->json();
    }
}