<?php
namespace Travijuu\BkmExpress\PosResponse;


interface PosResponseInterface
{

    public function isSuccess();

    public function setIsSuccess($success);

    public function getOrderId();

    public function setOrderId($orderId);

    public function getAuthCode();

    public function setAuthCode($authCode);

    public function getResponseCode();

    public function setResponseCode($responseCode);

    public function getResponseMessage();

    public function setResponseMessage($responseMessage);

    public function getTransactionId();

    public function setTransactionId($transactionId);

    public function getRawResponse();

    public function setRawResponse($rawResponse);

}