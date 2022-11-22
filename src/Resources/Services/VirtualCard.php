<?php 

namespace Bitsika\Resources\Services;

use Bitsika\Resources\Contracts\HttpClientInterface;

class VirtualCard
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
     * Get all transactions
     * 
     * @param array $params    filters
     * 
     * @return array
     */
    public function all(array $params = []) : array
    {
        $url = "virtual-card";

        $this->response = $this->http->get($url, $params);
        return $this->response->json();
    }

    /**
     * Get card by id
     * 
     * @return array
     */
    public function get($id) : array
    {
        $url = "virtual-card/{$id}";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Delete card by id
     * 
     * @return array
     */
    public function delete($id) : array
    {
        $url = "virtual-card/{$id}/delete";

        $this->response = $this->http->delete($url);
        return $this->response->json();
    }

    /**
     * Fund card by id
     * 
     * @return array
     */
    public function fund($id, array $params) : array
    {
        $url = "virtual-card/{$id}/fund";
        $params['card_id'] = $id;

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Withdraw from card by id
     * 
     * @return array
     */
    public function withdraw($id, array $params) : array
    {
        $url = "virtual-card/{$id}/withdraw";
        $params['card_id'] = $id;

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Get card Transactions
     * 
     * @return array
     */
    public function transactions($id) : array
    {
        $url = "virtual-card/{$id}/transactions";

        $this->response = $this->http->post($url);
        return $this->response->json();
    }

    /**
     * Block Card
     * 
     * @return array
     */
    public function block($id) : array
    {
        $url = "virtual-card/{$id}/block";

        $this->response = $this->http->post($url);
        return $this->response->json();
    }

    /**
     * Unblock Card
     * 
     * @return array
     */
    public function Unblock($id) : array
    {
        $url = "virtual-card/{$id}/unblock";

        $this->response = $this->http->post($url);
        return $this->response->json();
    }

    /**
     * Create Card
     * 
     * @return array
     */
    public function Create(array $params) : array
    {
        $url = "virtual-card/create";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }
}