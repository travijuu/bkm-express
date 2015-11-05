<?php
namespace Travijuu\BkmExpress;

use Travijuu\BkmExpress\Common\IncomingResult;
use Travijuu\BkmExpress\Common\Result;
use Travijuu\BkmExpress\Exception\UnexpectedDataType;
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

    public $defaultBank;

    public $bankList = [];

    public $virtualPosList = [];

    public $bankSystemList = ['Posnet', 'NestPay', 'Gvp'];


    public function __construct($mid, $successUrl, $cancelUrl, $privateKeyPath, $publicKeyPath, $bkmPublicKeyPath, $defaultBank = 'NestPay')
    {
        $this->mid              = $mid;
        $this->successUrl       = $successUrl;
        $this->cancelUrl        = $cancelUrl;
        $this->privateKeyPath   = $privateKeyPath;
        $this->publicKeyPath    = $publicKeyPath;
        $this->bkmPublicKeyPath = $bkmPublicKeyPath;
        $this->defaultBank      = $defaultBank;

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
            throw new VerificationException("Response cannot be verified!");
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

        if (Calculate::timeDiff($incomingResult->getTimestamp()) > 30) {
            throw new VerificationException('Request is not synchronized!');
        }

        if (! $verified) {
            throw new VerificationException('Response cannot be verified!');
        }

        return $incomingResult;
    }

    public function getBank($bankId, $bin = null)
    {
        foreach ($this->bankList as $bank) {
            if ($bank['id'] == $bankId) {
                if (!is_null($bin)) {
                    if(array_search($bin, array_column($bank['bins'], 'bin'))) {
                        return $bank;
                    }
                } else {
                    return $bank;
                }
            }
        }

        return null;
    }

    public function getPosResponse($bankId, $data)
    {
        $bank   = $this->getBank($bankId);
        $system = (!empty($bank['system']) ? $bank['system'] : $this->defaultBank);
        $class  = __NAMESPACE__ .'\PosResponse\Response' . $system;

        if (! class_exists($class)) {
            throw new ClassNotFoundException("{$class} not found!");
        }

        return new $class($data);
    }

    public function setDefaultBank($bank)
    {
        if (! in_array($bank, $this->bankSystemList)) {
            throw new UnexpectedDataType("Not acceptable bank type!");
        }

        $this->defaultBank = $bank;
    }
}