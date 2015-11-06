<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use Travijuu\BkmExpress\Payment\AbstractWSResponse;

class InitializePaymentWSResponse extends AbstractWSResponse
{
    /**
     * @var string
     */
    private $t;
    /**
     * @var string
     */
    private $url;
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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->ts;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->s;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->result->getMessage();
    }
}