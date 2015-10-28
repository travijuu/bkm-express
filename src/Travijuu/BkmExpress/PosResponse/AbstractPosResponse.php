<?php
namespace Travijuu\BkmExpress\PosResponse;

abstract class AbstractPosResponse
{
    /**
     * @var boolean
     */
    protected $success;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $authCode;

    /**
     * @var string
     */
    protected $responseCode;

    /**
     * @var string
     */
    protected $responseMessage;

    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @var string
     */
    protected $rawResponse;

    /**
     * @param $rawResponse
     */
    public function __construct($rawResponse)
    {
        $this->setRawResponse($rawResponse);

        $this->build();
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     *
     * @return $this
     */
    public function setIsSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @param string $authCode
     *
     * @return $this
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * @param string $responseCode
     *
     * @return $this
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getResponseMessage()
    {
        return $this->responseMessage;
    }

    /**
     * @param string $responseMessage
     *
     * @return $this
     */
    public function setResponseMessage($responseMessage)
    {
        $this->responseMessage = $responseMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     *
     * @return $this
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * @param string $rawResponse
     *
     * @return $this
     */
    public function setRawResponse($rawResponse)
    {
        $this->rawResponse = htmlspecialchars_decode($rawResponse);

        return $this;
    }

    public abstract function build();
}