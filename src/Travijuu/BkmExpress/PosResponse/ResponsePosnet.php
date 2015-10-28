<?php
namespace Travijuu\BkmExpress\PosResponse;


/**
 * Class ResponsePosnet
 * @package Travijuu\BkmExpress\PosResponse
 *
 * @example {"approved":"1","respCode":null,"respText":null,"hostlogkey":null,"authCode":null,"inst1":null,"amnt1":null,"point":null,"pointAmount":null,"totalPoint":null,"totalPointAmount":null,"tranDate":null,"yourIP":null}
 */
class ResponsePosnet extends AbstractPosResponse
{

    public function build()
    {
        $response = json_decode($this->getRawResponse());

        $this->setIsSuccess($response->approved)
             ->setResponseCode($response->respCode)
             ->setResponseMessage($response->respText)
             ->setAuthCode($response->authCode);

        // TODO: implement
        //$this->setOrderId();
        //$this->setTransactionId();
    }
}

