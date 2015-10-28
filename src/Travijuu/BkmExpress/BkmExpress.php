<?php
namespace Travijuu\BkmExpress;

use Travijuu\BkmExpress\Common\IncomingResult;
use Travijuu\BkmExpress\Common\Result;
use Travijuu\BkmExpress\Exception\VerificationException;
use Travijuu\BkmExpress\Payment\InitializePayment\BKMSoapClient;
use Travijuu\BkmExpress\Payment\InitializePayment\InitializePayment;
use Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentWSRequest;
use Travijuu\BkmExpress\Payment\InitializePayment\RedirectRequest;
use Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoServer;
use Travijuu\BkmExpress\Utility\Calculate;
use Travijuu\BkmExpress\Utility\Certificate;
use Travijuu\BkmExpress\Exception\ClassNotFoundException;
use SoapServer;
use Closure;

class BkmExpress
{
    public $mid;

    public $successUrl;

    public $cancelUrl;

    public $privateKeyPath;

    public $publicKeyPath;

    public $bkmPublicKeyPath;

    public $bankList = [];

    public $virtualPosList = [];


    public function __construct($mid, $successUrl, $cancelUrl, $privateKeyPath, $publicKeyPath, $bkmPublicKeyPath)
    {
        $this->mid            = $mid;
        $this->successUrl     = $successUrl;
        $this->cancelUrl      = $cancelUrl;
        $this->privateKeyPath = $privateKeyPath;
        $this->publicKeyPath  = $publicKeyPath;
        $this->bkmPublicKeyPath = $bkmPublicKeyPath;

        $this->bankList = include('Config/BkmBankList.php');
    }

    public function initPayment($wsdl, $sAmount, $cAmount, $banks)
    {
        $bkmClient          = new BKMSoapClient($wsdl, ['trace' => 1]);
        $initPayment        = new InitializePayment();
        $initPaymentRequest = new InitializePaymentWSRequest();

        $initPaymentRequest->setMerchantId($this->mid)
            ->setSuccessUrl($this->successUrl)
            ->setCancelUrl($this->cancelUrl)
            ->setSaleAmount($sAmount)
            ->setCargoAmount($cAmount)
            ->setBanks($banks)
            ->setTimestamp(date('Ymd-H:i:s'));

        $dataToBeHashed = $initPaymentRequest->getDataToBeHashed();
        $signature      = Certificate::sign($dataToBeHashed, $this->privateKeyPath);
        $verified       = Certificate::verify($signature, $dataToBeHashed, $this->publicKeyPath);

        if (! $verified) {
            throw new VerificationException("Private / Public key does not match!");
        }

        $initPaymentRequest->setSignature(base64_encode($signature));
        $initPayment->setRequest($initPaymentRequest);
        $bkmClient->setParams($initPayment);

        $response = $bkmClient->initializePayment();

        $verified = $response->verify($this->bkmPublicKeyPath);

        if (! $verified) {
            throw new VerificationException("Response can not be verified!");
        }

        if ($response->success()) {
            return new RedirectRequest($response, $this->privateKeyPath);
        }

        return null;
    }

    public function requestMerchInfo($wsdl, $virtualPosList, Closure $saveTokenCallback = null)
    {
        $this->virtualPosList = $virtualPosList;

        $server = new SoapServer($wsdl, ['classmap' => RequestMerchInfoServer::$classmap]);
        $server->setClass(
            'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoServer',
            $this->publicKeyPath,
            $this->privateKeyPath,
            $virtualPosList,
            $saveTokenCallback
        );
        $server->handle();
    }

    public function confirm($data)
    {
        $incomingResult = new IncomingResult($data);
        $verified       = $incomingResult->verify($this->bkmPublicKeyPath);

        if (Calculate::timeDiff($incomingResult->getTs()) > 30) {
            return Result::build('REQUEST_NOT_SYNCHRONIZED');
        }

        if (! $verified) {
            return Result::build('MAC_VERIFICATION_FAILED');
        }

        return $incomingResult;
    }

    public function getBank($bankId)
    {
        foreach ($this->bankList as $bank) {
            if ($bank['id'] == $bankId) {
                return $bank;
            }
        }
    }

    public function getPosResponse($bankId, $data)
    {
        $bank  = $this->getBank($bankId);
        $class = 'PosResponse\Response' . $bank['system'];

        if (! class_exists($class)) {
            throw new ClassNotFoundException("{$class} not found!");
        }

        return new $class($data);
    }
}