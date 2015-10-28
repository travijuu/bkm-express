<?php
namespace Travijuu\BkmExpress\PosResponse;


/**
 * Class ResponseNestPay
 * @package Travijuu\BkmExpress\PosResponse
 *
 * @example {"orderId":"0b1807ac-f49e-4df3-bb56-89254e2a2a0d","groupId":"0b1807ac-f49e-4df3-bb56-89254e2a2a0d","response":"Approved","authCode":"204844","hostRefNum":"218609943682","procReturnCode":"00","transId":"12186-JLcG-1-4979","errMsg":"","extra":{"settleId":"2766","trxDate":"20120704 09:11:28","errorCode":"","hostDate":null,"numCode":"00"}}
 */
class ResponseNestPay extends AbstractPosResponse
{

    public function build()
    {
        $response = json_decode($this->getRawResponse());

        $this->setIsSuccess($response->response == 'Approved')
            ->setOrderId($response->orderId)
            ->setTransactionId($response->transId)
            ->setResponseCode($response->extra->errorCode)
            ->setResponseMessage($response->errMsg)
            ->setAuthCode($response->authCode);
    }
}