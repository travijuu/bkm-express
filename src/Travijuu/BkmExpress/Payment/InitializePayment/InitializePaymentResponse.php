<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use Travijuu\BkmExpress\Utility\Certificate;

class InitializePaymentResponse
{

    /**
     * @var InitializePaymentWSResponse
     */
    public $initializePaymentWSResponse;

	public function success()
	{
		return $this->initializePaymentWSResponse->getResult()->getCode() == 0;
	}

	public function getMessage()
	{
		return $this->initializePaymentWSResponse->getResult()->getMessage();
	}

	public function getWSResponse()
	{
		return $this->initializePaymentWSResponse;
	}

    public function verify($bkmPublicKeyPath)
    {
        $dataToBeVerified = $this->initializePaymentWSResponse->getToken() .
                            $this->initializePaymentWSResponse->getUrl() .
                            $this->initializePaymentWSResponse->getTimestamp();

        $decodedSignature = base64_decode($this->initializePaymentWSResponse->getSignature());

        return Certificate::verify($decodedSignature, $dataToBeVerified, $bkmPublicKeyPath);
    }
}