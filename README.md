# BKM Express PHP Payment Library 

[![Build Status](https://travis-ci.org/travijuu/bkm-express.svg?branch=master)](https://travis-ci.org/travijuu/bkm-express)

BKM Express is easy and fast payment system in Turkey which makes possible online payments without giving whole credit card information so this library provides you a simple API for it.

######NOTE: currently working on this project. Documentation has not been completed yet.

## Installation

You can simply install this library via [Composer](http://getcomposer.org/). 

Firstly, add this line into your `composer.json`

```json
{
    "require": {
        "travijuu/bkm-express": "1.0.3"
    }
}
```
and then run `composer update` command.

## Payment Steps in BKM Express

There are four steps to make payment transaction.

* **Initialize Payment** - prepare your data (banks, installments, payment options, etc..), send them to BKM Express, get the result from BKM Express and make POST request to BKM after the verification.
* **Request Merch Info** - BKM makes SOAP request to you to get your virtual pos info according to client's credit card selection.
* **Success/Cancel URL** - BKM Express makes payment transaction request to defined bank instead of you when it gets your virtual pos info. According to the transaction result, it makes another request to success or cancel url.
* **Confirmation URL** - Apart from success/fail url request, BKM Express makes another request to your confirmation url. This request is same as success/fail request so it is an extra request to be ensure that preventing data loss from a failure in success/fail request  

## Basic Usage

Let's start with first step.

### Initialize Payment

```php
use Travijuu\BkmExpress\BkmExpress;
use Travijuu\BkmExpress\Common\Bank;
use Travijuu\BkmExpress\Common\Bin;
use Travijuu\BkmExpress\Common\Installment;

$mid              = '7b928290-b6d2-469e-ac10-29eb36b8c1f6'; // BKM Merchant ID
$successUrl       = 'https://example.com/bkm/success';
$cancelUrl        = 'https://example.com/bkm/error';
$privateKeyPath   = '/path/to/mykey.pem';
$publicKeyPath    = '/path/to/mykey.pub';
$bkmPublicKeyPath = '/path/to/bkm.pub';
// Infrastructure of the bank you choose as a default payment gateway. 
// ['Posnet', 'NestPay', 'Gvp'] one of them should be chosen.
$defaultBank      = 'NestPay';

$bkm = new BkmExpress($mid, $successUrl, $cancelUrl, $privateKeyPath, $publicKeyPath, $bkmPublicKeyPath, $defaultBank);

$wsdl    = '/path/to/BkmExpressPaymentService.wsdl';
$sAmount = 100.50; // Sale Amount
$cAmount = 4.50; // Cargo Amount
$banks   = [];

$bank        = new Bank('0062', 'Garanti Bank', 'Garanti Bank via BKM Express');
$bin         = new Bin('554960');
$installment = new Installment($cAmount, $sAmount, 1, 'Garanti Bank without installment', true);
$bin->addInstallment($installment);
$installment = new Installment($cAmount, $sAmount, 3, 'Garanti Bank with 3 installments', true);
$bin->addInstallment($installment);

$bank->addBin($bin);
$banks[] = $bank;

$response = $bkm->initPayment($wsdl, $sAmount, $cAmount, $banks);

```

Then, make POST request to `$response->getUrl()` with 3 parameters by redirecting page to BKM Express

```php
[
    't'  => $response->getToken(),
    's'  => $response->getSignature(),
    'ts' => $response->getTimestamp()
]
```
Another way of POST request. (But not preferred)

```html
<form name="bankexpresspayForm" id="bankexpresspayForm" action="<?php echo $response->getUrl(); ?>" method="POST">
    <input type="hidden" name="t"  value="<?php echo $response->getToken(); ?>">
    <input type="hidden" name="ts" value="<?php echo $response->getSignature(); ?>">
    <input type="hidden" name="s"  value="<?php echo $response->getTimestamp(); ?>">
    <!-- To support javascript unaware/disabled browsers -->
    <noscript>
        <center>
            Eğer yönlenme olmazsa lütfen tıklayınız.<br>

        </center>
    </noscript>
</form>

<script type="text/javascript">
    setTimeout(function(){
        $('#bankexpresspayForm').submit(); 
    },500);
</script>
```

After this step, you should be redirected to BKM Express website.

Once customer logged into the system, available credit cards will be listed. So, customer can see all installment options which are sent in initialize payment request.

After credit card selection, a SMS password will be requested from customer.

In next step, BKM Express will make a SOAP request to your application to get bank API information which is related to customer's selected card (`Request Merch Info`)

### Request Merch Info

**IMPORTANT:** You should declare a webservice url to BKM Express customer service.

Thus, BKM Express will make a SOAP request to this url to get bank API information from your server.

```php
use Travijuu\BkmExpress\Common\VirtualPos;
use Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSRequest;

$wsdlServer     = '/path/to/RequestMerchInfoService_latest.wsdl';
$virtualPosList = [];

$virtualPos = new VirtualPos();
$virtualPos->setPosUrl('https://sanalposprovtest.garanti.com.tr/VPServlet')
    ->setPosUid('600218');
    ->setPosPwd('123qweASD');
    ->setMpiUrl('https://sanalposprovtest.garanti.com.tr/servlet/gt3dengine')
    ->setMpiUid('600218')
    ->setMpiPwd('123qweASD')
    ->setMd('')
    ->setXid('')
    ->setCIp('192.168.0.1')
    ->setExtra('{"terminalprovuserid":"PROVAUT", "terminalmerchantid":"7000679", "storekey":"12345678", "terminalid":"30690168"}')
    ->setIs3ds(false)
    ->setIs3dsFDec(false);

// Garanti Bank Id: 0062
$virtualPosList['0062'] = $virtualPos;

/* This callback can help you to be informed what kind of
 * payment method is selected in BKM Express website. 
 * You may insert this into database for info purposes.
 * Note: This is optional.
 */
$callback = function(RequestMerchInfoWSRequest $request) {
    $token       = $response->getToken();
    $bankId      = $response->getBankId();
    $installment = $response->getInstallment();
    ...
}

$bkm->requestMerchInfo($wsdlServer, $virtualPosList, $callback);
```

The result of this request will be returned to BKM Express and it will make a bank transaction with your bank API information. After that, BKM Express will make a POST request according to the result of the bank transaction (`success / cancel url`)

### Success/Cancel URL

BKM Express will make a POST request to success url (https://example.com/bkm/success) or cancel url (https://example.com/bkm/error)
You need to get the POST data and pass it into confirm function

**Note:** https://example.com/bkm/success/{orderCode} You can use your success url like this so that can help you to understand which order you are trying to pay.
```php
// This part can be used in both success and cancel url. $confirmation->success() will return the result.
$data = $_POST;
$confirmation = $bkm->confirm($data);

if ($confirmation->isSuccess()) {
    // remember the callback which I decribed above. If you save $token, $bankId, $installment into your database, now you can use them to identify the posResponse. 
    $token       = $confirmation->getToken();
    $bankId      = '0062'; // get the bank Id from database according to token
    $posResponse = $bkm->getPosResponse($bankId, $confirmation->getPosRef());
    
    // This means that bank transcation is successfully completed so you got the money
    // now you can save the success result to your database.
    if ($posResponse->isSuccess()) {
        $authCode    = $posResponse->getAuthCode();
        $rawResponse = $posResponse->getRawResponse();
        ...
    } else {
        // Transaction failed so get the error message and code
        $errorCode    = $posResponse->getResponseCode();
        $errorMessage = $posResponse->getResponseMessage();
        ...
    }
}
```

### Confirmation URL

Apart from `success url`, BKM Express will do this POST request to your confirmation URL for precaution. They assumed that the request sent to `success url` may not be reached.

**IMPORTANT:** You should declare confirmation url to BKM Express customer service.

```php
$data = $_POST;
$confirmation = $bkm->confirm($data);

/* You can use the same methodology as above. 
 * Save $token, $bankId, $installment into your database, 
 * now you can use them to identify the posResponse. (Garanti, YKB, Akbank, etc..)
 */
$token       = $confirmation->getToken();
$bankId      = '0062'; // get the bank Id from database according to token
$posResponse = $bkm->getPosResponse($bankId, $confirmation->getPosRef());

```

## TODO

* Agreements will be added.



## Contribute

If you have any suggestions, feel free to create an issue here on Github and/or fork this repo, make changes and submit a pull request!
