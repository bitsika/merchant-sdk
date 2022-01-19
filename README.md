# Bitsika Merchant SDK

The Bitsika Merchant PHP library gives convenient access to the Merchant API from applications written in the PHP language.

## API Documentation
https://documenter.getpostman.com/view/12690520/UUy39RrV

## Requirements
- PHP >= 7.0
- A Bitsika merchant `secret_key`.
>> As indicated above, In other to use the package, you need a Bisika Merchant Secret key. If you do not have one, you can get  [here](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security)

## Installation
This package requires PHP >= 7.0 and composer to run.
Run the command below to Install.

```bash
composer require bitsika/merchant-sdk-php
```

To use the bindings, use Composer's autoload:
```bash
require_once __DIR__ . '/vendor/autoload.php';
```

## Dependencies
The binding relies on [Guzzle](https://guzzle3.readthedocs.io/index.html) to work fine

## Getting Started
Below are basic examples on how to use the package.
>> Here we would assume `bsk_sec_SoMemAGicalNumBErForteSt` is our merchant's secret key. (Note: You should change this to your merchant's secret key when testing. If you do not have one, visit [here](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security) to get it)


```php
require_once __DIR__ . '/vendor/autoload.php';

use Bitsika\Merchant;

$merchant = new Merchant('bsk_sec_SoMemAGicalNumBErForteSt');
```

From the sample above, the variable `$merchant` is now an instance of a Bitsika merchant, and can be used to perform any action on the merchant. 

# Merchant
### Get merchant detail
```php
$response = $merchant->detail();

var_dump($response);
```

### Get merchant statistics
```php
$response = $merchant->statistics();

var_dump($response);
```

# Invoices

### Create invoice
```php
$response = $merchant->invoices()->create([
    "title" => "Coins of life", 
    "description" => "Biscuits that makes the brain go pita paka, pita paka", 
    "amount" => 2000000, 
    "currency" => "NGN", 
    "recipient_email" => "ibk@bitsika.africa", 
    "photo_url" => "https://lindaikeji.com" 
]);

var_dump($response);
```

### Get all invoices
```php
$response = $merchant->invoices()->all();

var_dump($response);
```

### Get invoice by id
```php
$invoiceId = '948641e6-b4ea-4053-a60b-7052777f33fa';
$response = $merchant->invoices()->get($invoiceId);

var_dump($response);
```

### Delete invoice
```php
$invoiceId = '948641e6-b4ea-4053-a60b-7052777f33fa';
$response = $merchant->invoices()->delete($invoiceId);

var_dump($response);
```

# Transactions
###  Get all transactions
```php
$response = $merchant->transaction()->all([
    ...
    'type' => 'OUT',
    'mode' => 'BTC',
    ...
]);

var_dump($response);
```
You can add other filters to the array. Alternatively, if you do not plan on filtering your response, you can either leave the array empty or don't pass any argument into it.

###  Get transaction statistics
```php
$response = $merchant->transaction()->statistics();

var_dump($response);
```

### Verify transaction 
```php
$transactionId = 591;
$response = $merchant->transaction()->verify($transactionId);

var_dump($response);
```

### Cash out
```php
$response = $merchant->transaction()->cashOut([
   "platform" => "Flutterwave", 
   "amount" => 4000, 
   "currency" => "NGN", 
   "debit_from" => "USD", 
   "country" => "Nigeria", 
   "account_name" => "Precious", 
   "bank_code" => "044", 
   "account_number" => "0690000044" 
]);

var_dump($response);
```

### Send Cash
```php
$response = $merchant->transaction()->sendCash([
   "platform" => "Bitsika", 
   "amount" => 100, 
   "currency" => "USD", 
   "username" => "davido", 
   "debit_from" => "USD", 
   "by_id" => "", 
   "for" => "" 
]);

var_dump($response);
```

### Add Cash
```php
$response = $merchant->transaction()->addCash([
   "platform" => "Flutterwave", 
   "amount" => 900, 
   "currency" => "USD", 
   "number" => "0556451981", 
   "username" => "akua", 
   "network" => "Vodafone", 
   "address" => "2MysF8fC8qX7BZqRQB9yHa8mYhxW8evzCSc", 
   "account_number" => "0000000000", 
   "account_name" => "Test", 
   "bank_code" => "057", 
   "country" => "Ghana" 
]);

var_dump($response);
```

### Get transaction balances
```php
$response = $merchant->transaction()->balances();

var_dump($response);
```

# Virtual card

###  Create Card
```php
$response = $merchant->virtualCard()->create([
   "name" => "Tommie Nii Darku", 
   "currency" => "USD", 
   "amount" => 11, 
   "debit_from" => "GHS" 
]);

var_dump($response);
```

###  Get all virtual cards
```php
$response = $merchant->virtualCard()->all();

var_dump($response);
```

###  Get virtual card by id
```php
$cardId = 113;
$response = $merchant->virtualCard()->get($cardId);

var_dump($response);
```

###  Delete virtual card by id
```php
$cardId = 113;
$response = $merchant->virtualCard()->delete($cardId);

var_dump($response);
```

###  Fund virtual card by id
```php
$cardId = 113;
$response = $merchant->virtualCard()->fund($cardId, [
   "amount" => "10", 
   "currency" => "USD", 
   "debit_from" => "GHS"
]);

var_dump($response);
```

###  Withdraw from card by id
```php
$cardId = 113;
$response = $merchant->virtualCard()->withdraw($cardId, [
   "amount" => "5"
]);

var_dump($response);
```

###  Get card Transactions
```php
$cardId = 113;
$response = $merchant->virtualCard()->transactions($cardId);

var_dump($response);
```

###  Block Card
```php
$cardId = 113;
$response = $merchant->virtualCard()->block($cardId);

var_dump($response);
```

###  Unblock Card
```php
$cardId = 113;
$response = $merchant->virtualCard()->unblock($cardId);

var_dump($response);
```

###  Create virtual bank account
```php
$response = $merchant->banks()->create([
  "account_name" => "Tommie N Darku"
]);

var_dump($response);
```

### Verify Bank account
```php
...
use Bitsika\Resources\Supports\Country;
...

// Verify Ghana banks
$response = $merchant->banks()->verifyAccount(Country::GHANA, [
    "account_number" => "0218420116",
    "bank_code" => "058"
]);

// Verify Nigeria banks
$response = $merchant->banks()->verifyAccount(Country::NIGERIA, [
    "account_number" => "0218420116",
    "bank_code" => "058"
]);

var_dump($response);
```

## Invoice Webhooks
Whenever invoices are paid for, events are triggered and notifications are sent to the webhooks you provided on your `keys and security` page. Your webhook url is expected to be an unauthenticated `POST` request url.

Once payments are recieved, weather failed or successful, we make a post request containing the event object to your webhook url.

The request object contains the `event`, `invoice_id` and `transaction` details. 

The `event` key will be `invoice.payment_failed` for failed payments, or `invoice.payment_success` for successful payments.

The `invoice_id` is the `id` of the invoice being paid for, while the `transaction` key contains a json object of the payment.

### Verifying webhooks
Everytime a request is made to your webhook url, for security reasons, we also send a `x-bitsika-signature` in the header. This contains a `HMAC SHA512` hash of the payload signed using your secret key.

```php
if($_SERVER['HTTP_X_BITSIKA_SIGNATURE'] !== hash_hmac('sha512', $input, YOUR_SECRET_KEY_HERE))
    exit();
```

**Sample Response**
An example of the response to expect:
```
{
   "id": 935,
   "reference": "87-1601554148-1530",
   "currency": "USD",
   "status": "Initiated",
   "amount": 50,
   "type": "Out",
   "created_at": "2020-10-01 12:09:08",
   "updated_at": "2020-10-01 12:09:08",
   "from_account": {
      "id": 87,
      "name": "Tom Tom Darku",
      "username": "td"
   }
}
```