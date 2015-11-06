<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use Travijuu\BkmExpress\Common\Result;

class RequestMerchInfoServer
{

    /**
     * Full path of your public key
     *
     * @var string
     */
    public $publicKeyPath;

    /**
     * Full path of your private key
     *
     * @var string
     */
    public $privateKeyPath;

    /**
     *
     * @var \Closure $callback
     */
    public $callback;

    /**
     * @var array
     */
    public $virtualPosList = [];

    /**
     * @var array
     */
    public static $classmap = [
        'requestMerchInfo'            => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfo',
        'requestMerchInfoWSRequest'   => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSRequest',
        'requestMerchInfoResponse'    => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoResponse',
        'requestMerchInfoWSResponse'  => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSResponse',
        'requestMerchInfoServiceImpl' => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoServer',
        'result'                      => 'Travijuu\BkmExpress\Common\Result',
    ];

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

        // need to be returned one of given virtual pos list
        if (is_null($virtualPos)) {
            $response->getWSResponse()->setResult(Result::build('UNKNOWN_ERROR'));
            return $response;
        }

        // makes the verification of the request
        if ($requestInfoAction->verifyRequest($requestMerchInfo->getWSRequest(), $this->publicKeyPath)) {
            $response->getWSResponse()->setResult(Result::build('MAC_VERIFICATION_FAILED'));
            return $response;
        }

        // this helps to send the request data to the application
        if (is_callable($this->callback)) {
            call_user_func($this->callback, $requestMerchInfo->getWSRequest());
        }

        // prepare the response to BKM Express
        $response->setVirtualPos($virtualPos);
        $response->getWSResponse()->setResult(Result::build('SUCCESS'));
        $response->getWSResponse()->setTimestamp(date("Ymd-H:i:s"));
        $signature = $requestInfoAction->signResponse($response->getWSResponse(), $this->privateKeyPath);
        $response->getWSResponse()->setSignature($signature);

        return $response;
    }
}