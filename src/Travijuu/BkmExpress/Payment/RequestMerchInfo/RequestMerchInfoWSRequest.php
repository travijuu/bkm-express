<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;


class RequestMerchInfoWSRequest
{

    /**
     * @var string
     */
    private $t;
    /**
     * @var string
     */
    private $bid;
    /**
     * @var string
     */
    private $bName;
    /**
     * @var string
     */
    private $cBin;
    /**
     * @var integer
     */
    private $nofInst;
    /**
     * @var string
     */
    private $ts;
    /**
     * @var string
     */
    private $s;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->t;
    }

    /**
     * @param string $token
     *
     * @return self
     */
    public function setToken($token)
    {
        $this->t = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankId()
    {
        return $this->bid;
    }

    /**
     * @param string $bankId
     *
     * @return self
     */
    public function setBankId($bankId)
    {
        $this->bid = $bankId;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bName;
    }

    /**
     * @param string $bankName
     *
     * @return self
     */
    public function setBankName($bankName)
    {
        $this->bName = $bankName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardBin()
    {
        return $this->cBin;
    }

    /**
     * @param string $cardBin
     *
     * @return self
     */
    public function setCardBin($cardBin)
    {
        $this->cBin = $cardBin;

        return $this;
    }

    /**
     * @return int
     */
    public function getInstallment()
    {
        return $this->nofInst;
    }

    /**
     * @param int $installment
     *
     * @return self
     */
    public function setInstallment($installment)
    {
        $this->nofInst = $installment;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->ts;
    }

    /**
     * @param string $timestamp
     *
     * @return self
     */
    public function setTimestamp($timestamp)
    {
        $this->ts = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->s;
    }

    /**
     * @param string $signature
     *
     * @return self
     */
    public function setSignature($signature)
    {
        $this->s = $signature;

        return $this;
    }
}