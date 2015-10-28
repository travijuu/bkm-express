<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use Travijuu\BkmExpress\Common\VirtualPos;
use Travijuu\BkmExpress\Utility\Certificate;

class RequestMerchInfoAction
{

    public function getVirtualPos($bankId, $virtualPosList)
    {
        foreach($virtualPosList as $key => $virtualPos) {
            if ($key == $bankId) {
                return $virtualPos;
            }
        }
    }

    public function verifyRequest(RequestMerchInfoWSRequest $wsRequest, $bkmPublicKeyPath)
    {
        $decodedSignature = base64_decode($wsRequest->getSignature());

        $dataToBeHashed   = $wsRequest->getToken()       . $wsRequest->getBankId() .
                            $wsRequest->getBankName()    . $wsRequest->getCardBin() .
                            $wsRequest->getInstallment() . $wsRequest->getTimestamp();

        return Certificate::verify($decodedSignature, $dataToBeHashed, $bkmPublicKeyPath);
    }

    public function signResponse(RequestMerchInfoWSResponse $wsResponse, $privateKeyPath)
    {
        $dataToBeHashed = $wsResponse->getToken()  . $wsResponse->getPosUrl() .
                          $wsResponse->getPosUid() . $wsResponse->getPosPwd() .
                          $wsResponse->isS3Dauth() . $wsResponse->getMpiUrl() .
                          $wsResponse->getMpiUid() . $wsResponse->getMpiPwd() .
                          $wsResponse->getMd()     . $wsResponse->getXid() .
                          $wsResponse->isS3DFDec() . $wsResponse->getCIp() .
                          $wsResponse->getExtra()  . $wsResponse->getTimestamp();

        return base64_encode(Certificate::sign($dataToBeHashed, $privateKeyPath));
    }
}