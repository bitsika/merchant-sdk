<?php 

namespace Bitsika\Resources\Services;

use Bitsika\Resources\Contracts\HttpClientInterface;

class Invoice
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
     * Create an invoice for the merchant
     * 
     * @param int $tierId    Merchant Tier Id 
     * 
     * @return array
     */
    public function create(array $params) : array
    {
        $url = "invoices/create";

        $this->response = $this->http->post($url, $params);
        return $this->response->json();
    }

    /**
     * Get invoice by id
     * 
     * @param string $id
     * 
     * @return array
     */
    public function get(string $id)
    {
        $url = "invoices/detail/{$id}";

        $this->response = $this->http->get($url);

        return $this->response->json();
    }

    /**
     * Get all invoices for the merchant
     * 
     * @param int $perPage
     * 
     * @return array
     */
    public function all(int $perPage = 15, array $params = [])
    {
        $url = "invoices";
        $params['per_page'] = $perPage;

        $this->response = $this->http->get($url, $params);

        return $this->response->json();
    }

    /**
     * Delete invoice by id
     * 
     * @param string $id
     * 
     * @return array
     */
    public function delete(string $id)
    {
        $url = "invoices/{$id}";

        $this->response = $this->http->delete($url);

        return $this->response->json();
    }
}