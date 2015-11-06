<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use Travijuu\BkmExpress\Common\VirtualPos;

class RequestMerchInfoResponse
{

    /**
     * @var RequestMerchInfoWSResponse
     */
    public $requestMerchInfoWSResponse;

    function __construct()
    {
        $this->requestMerchInfoWSResponse = new RequestMerchInfoWSResponse();
    }

    /**
     * @return RequestMerchInfoWSResponse
     */
    public function getWSResponse()
    {
        return $this->requestMerchInfoWSResponse;
    }

    /**
     * @param VirtualPos $virtualPos
     */
    public function setVirtualPos(VirtualPos $virtualPos)
    {
        $this->requestMerchInfoWSResponse->setPosUrl($virtualPos->getPosUrl());
        $this->requestMerchInfoWSResponse->setPosUid($virtualPos->getPosUid());
        $this->requestMerchInfoWSResponse->setPosPwd($virtualPos->getPosPwd());

        $this->requestMerchInfoWSResponse->setMpiUrl($virtualPos->getMpiUrl());
        $this->requestMerchInfoWSResponse->setMpiUid($virtualPos->getMpiUid());
        $this->requestMerchInfoWSResponse->setMpiPwd($virtualPos->getMpiPwd());
        $this->requestMerchInfoWSResponse->setS3Dauth($virtualPos->getIs3ds());
        $this->requestMerchInfoWSResponse->setMd($virtualPos->getMd());
        $this->requestMerchInfoWSResponse->setXid($virtualPos->getXid());

        $this->requestMerchInfoWSResponse->setS3DFDec($virtualPos->getIs3dsFDec());
        $this->requestMerchInfoWSResponse->setCIp($virtualPos->getCIp());
        $this->requestMerchInfoWSResponse->setExtra($virtualPos->getExtra());
    }
}