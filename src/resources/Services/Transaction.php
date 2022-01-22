<?php 

namespace Bitsika\Resources\Services;

use Bitsika\Resources\Contracts\HttpClientInterface;

class Transaction
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
        $url = "transactions/all";

        $this->response = $this->http->get($url, $params);
        return $this->response->json();
    }

    /**
     * Get transaction statistics
     * 
     * @param array $params    filters
     * 
     * @return array
     */
    public function statistics(array $params = []) : array
    {
        $url = "transactions/statistics";

        $this->response = $this->http->get($url, $params);
        return $this->response->json();
    }

    /**
     * Get a transaction detail
     * 
     * @param int $id
     * 
     * @return array
     */
    public function get($id) : array
    {
        $url = "transactions/{$id}";

        $this->response = $this->http->get($url, ['id' => $id]);
        return $this->response->json();
    }

    /**
     * Cash Out
     * 
     * @param array $params
     * 
     * @return array
     */
    public function cashOut(array $params) : array
    {
        $url = "transactions/cash-out/nigeria";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Send Cash
     * 
     * @param array $params
     * 
     * @return array
     */
    public function sendCash(array $params) : array
    {
        $url = "transactions/send-cash";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Add Cash
     * 
     * @param array $params
     * 
     * @return object
     */
    public function addCash(array $params) : array
    {
        $url = "transactions/add-cash";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Balances
     * 
     * @return object
     */
    public function balances() : array
    {
        $url = "transactions/balance";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

}