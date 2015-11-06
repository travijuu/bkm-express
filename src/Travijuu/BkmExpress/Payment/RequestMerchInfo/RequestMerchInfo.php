<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

class RequestMerchInfo
{

    /**
     * @var RequestMerchInfoWSRequest
     */
    public $requestMerchInfoWSRequest;

    public function __construct()
    {
        $this->requestMerchInfoWSRequest = new RequestMerchInfoWSRequest();
    }

    /**
     * @return RequestMerchInfoWSRequest
     */
    public function getWSRequest()
    {
        return $this->requestMerchInfoWSRequest;
    }
}