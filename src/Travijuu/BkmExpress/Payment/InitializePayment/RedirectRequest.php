<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use Travijuu\BkmExpress\Utility\Certificate;

class RedirectRequest
{

    /**
     * @var string
     */
    public $t;

    /**
     * @var string
     */
    public $s;

    /**
     * @var string
     */
    public $ts;

    /**
     * @var string
     */
    public $url;


    /**
     * @param InitializePaymentResponse $response
     * @param $privateKeyPath
     */
    public function __construct(InitializePaymentResponse $response, $privateKeyPath)
    {
        $this->t      = $response->getWSResponse()->getToken();
        $this->url    = $response->getWSResponse()->getUrl();

        $this->createSignature($privateKeyPath);
    }

    /**
     * @param $privateKeyPath
     */
    public function createSignature($privateKeyPath)
    {
        $this->ts = date("Ymd-H:i:s");
        $data     = $this->t . $this->ts;
        $this->s  = base64_encode(Certificate::sign($data, $privateKeyPath));
    }

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
    public function getSignature()
    {
        return $this->s;
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
    public function getUrl()
    {
        return $this->url;
    }
}