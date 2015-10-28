<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use Travijuu\BkmExpress\Common\Result;

class RequestMerchInfoServer
{

    public $publicKeyPath;
    public $privateKeyPath;
    public $callback;
    public $virtualPosList;

    public static $classmap = array(
        'requestMerchInfo'            => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfo',
        'requestMerchInfoWSRequest'   => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSRequest',
        'requestMerchInfoResponse'    => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoResponse',
        'requestMerchInfoWSResponse'  => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSResponse',
        'requestMerchInfoServiceImpl' => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoServer',
        'result'                      => 'Travijuu\BkmExpress\Common\Result',
    );

    public function __construct($publicKeyPath, $privateKeyPath, $virtualPosList, $callback)
    {
        $this->publicKeyPath    = $publicKeyPath;
        $this->privateKeyPath   = $privateKeyPath;
        $this->callback         = $callback;
        $this->virtualPosList   = $virtualPosList;
    }

    /**
     * @param RequestMerchInfo $requestMerchInfo
     * @return RequestMerchInfoResponse
     */
    public function requestMerchInfo($requestMerchInfo)
    {
        $response = new RequestMerchInfoResponse();
        $response->getWSResponse()->setToken($requestMerchInfo->getWSRequest()->getToken());

        $requestInfoAction = new RequestMerchInfoAction();
        $virtualPos = $requestInfoAction->getVirtualPos($requestMerchInfo->getWSRequest()->getBankId(), $this->virtualPosList);

        if (is_null($virtualPos)) {

            $response->getWSResponse()->setResult(Result::build('UNKNOWN_ERROR'));

            return $response;
        }

        if ($requestInfoAction->verifyRequest($requestMerchInfo->getWSRequest(), $this->publicKeyPath)) {

            $response->getWSResponse()->setResult(Result::build('MAC_VERIFICATION_FAILED'));

            return $response;
        }

        if (is_callable($this->callback)) call_user_func($this->callback, $requestMerchInfo->getWSRequest());

        $response->setVirtualPos($virtualPos);
        $response->getWSResponse()->setResult(Result::build('SUCCESS'));
        $response->getWSResponse()->setTimestamp(date("Ymd-H:i:s"));
        $signature = $requestInfoAction->signResponse($response->getWSResponse(), $this->privateKeyPath);
        $response->getWSResponse()->setSignature($signature);

        return $response;
    }
}