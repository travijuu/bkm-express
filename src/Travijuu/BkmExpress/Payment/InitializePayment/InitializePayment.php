<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

class InitializePayment
{

	public $initializePaymentWSRequest;

    public function getRequest()
    {
        return $this->initializePaymentWSRequest;
    }

	public function setRequest(InitializePaymentWSRequest $initializePaymentWSRequest)
	{
		$this->initializePaymentWSRequest = $initializePaymentWSRequest;

        return $this;
	}
}