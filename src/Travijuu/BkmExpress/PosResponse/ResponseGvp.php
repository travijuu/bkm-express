<?php
namespace Travijuu\BkmExpress\PosResponse;


/**
 * Class ResponseGvp
 * @package Travijuu\BkmExpress\PosResponse
 *
 * @example {"order":{"orderId":"55d205ad86324642a157cd0ac8f87277"},"transaction":{"response":{"source":"HOST","code":"00","reasonCode":"00","message":"Approved","errorMsg":"","sysErrorMsg":""},"refNo":"218613613876","authCode":"127489","batchNo":"001048","seqNo":"000003","provDate":"20120704 13:13:01","hostMsgList":[],"rewardList":[],"chequeList":[]}}
 */
class ResponseGvp extends AbstractPosResponse implements PosResponseInterface
{

    public function build()
    {
        $response = json_decode($this->getRawResponse());

        $this->setIsSuccess($response->transaction->response->message == 'Approved')
            ->setOrderId($response->order->orderId)
            ->setResponseCode($response->transaction->response->code)
            ->setResponseMessage($response->transaction->response->errorMsg . $response->transaction->response->sysErrorMsg)
            ->setAuthCode($response->transaction->authCode);
    }
}