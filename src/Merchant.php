<?php 

namespace Bitsika;

use Bitsika\Resources\Supports\Http;
use Bitsika\Resources\Services\Invoice;
use Bitsika\Resources\Services\Customer;
use Bitsika\Resources\Services\Transaction;
use Bitsika\Resources\Config\MerchantConfig;

class Merchant
{
    /**
     * Merchant test secret key prefix
     * 
     * @var string
     */
    const TEST_KEY_PREFIX = 'bsk_sec_test_';
    
    /**
     * Merchant Secret Key 
     * 
     * @var string
     */
    protected $secretKey;
    
    /**
     * Http client
     * 
     * @var Http
     */
    protected $http;
    
    /**
     * Http response
     * 
     * @var array
     */
    protected $response;
    
    /**
     * Is staging environment
     * 
     * @var bool
     */
    protected $isTestEnvironment;
    
    /**
     * Create instance of Bitsika
     * 
     * @param string $secretKey   Merchant Secret Key 
     * 
     * @return void
     */
    public function __construct(string $secretKey)
    {
        if (! is_string($secretKey) || ! (substr($secretKey, 0, 8) === 'bsk_sec_')) {
            throw new \InvalidArgumentException("Invalid secret key passed. {$secretKey}");
        }

        $this->secretKey = $secretKey;
        $this->setEnvironment();
        $this->setHttpService();
    }

    /**
     * Get merchant detail
     * 
     * @return array
     */
    public function detail(): array
    {
        $url = "detail";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Get merchant statistics
     * 
     * @return array
     */
    public function statistics(): array
    {
        $url = "statistics";

        $this->response = $this->http->get($url);
        return $this->response->json();
    }

    /**
     * Get an instance of the invoice service
     * 
     * @return Invoice
     */
    public function invoices(): Invoice
    {
        return new Invoice($this->http);
    }

    /**
     * Get an instance of the transaction service
     * 
     * @return Transaction
     */
    public function transaction(): Transaction
    {
        return new Transaction($this->http);
    }

    /**
     * Get an instance of the customer service
     * 
     * @return Customer
     */
    public function customer(): Customer
    {
        return new Customer($this->http);
    }

    /**
     * Set the request environment
     * 
     * @return void
     */
    private function setEnvironment(): void
    {
        $this->isTestEnvironment = is_string($this->secretKey) && (substr($this->secretKey, 0, 13) === 'bsk_sec_test_');
    }

    /**
     * Set the request Http service
     * 
     * @return void
     */
    private function setHttpService(): void
    {
        $this->http = new Http(
            $this->isTestEnvironment ? 
            MerchantConfig::STAGING_API_BASE_URL : 
            MerchantConfig::API_BASE_URL
        );

        $this->http->withToken($this->secretKey)
            ->withHeader(['x-service-name' => MerchantConfig::SERVICE_NAME]);
    }
}