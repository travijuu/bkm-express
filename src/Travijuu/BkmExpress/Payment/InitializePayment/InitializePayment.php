<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

/**
 * Class InitializePayment
 * @package Travijuu\BkmExpress\Payment\InitializePayment
 */
class InitializePayment
{

    /**
     * @var InitializePaymentWSRequest
     */
    public $initializePaymentWSRequest;


    /**
     * @return InitializePaymentWSRequest
     */
    public function getRequest()
    {
        return $this->initializePaymentWSRequest;
    }

    /**
     * @param InitializePaymentWSRequest $initializePaymentWSRequest
     * @return $this
     */
    public function setRequest(InitializePaymentWSRequest $initializePaymentWSRequest)
    {
        $this->initializePaymentWSRequest = $initializePaymentWSRequest;

        return $this;
    }
}