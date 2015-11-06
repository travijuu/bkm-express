<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use Travijuu\BkmExpress\Utility\Certificate;

class InitializePaymentResponse
{

    /**
     * @var InitializePaymentWSResponse
     */
    public $initializePaymentWSResponse;

    /**
     * @return bool
     */
    public function success()
	{
		return $this->initializePaymentWSResponse->getResult()->getCode() == 0;
	}

    /**
     * @return string
     */
    public function getMessage()
	{
		return $this->initializePaymentWSResponse->getResult()->getMessage();
	}

    /**
     * @return InitializePaymentWSResponse
     */
    public function getWSResponse()
	{
		return $this->initializePaymentWSResponse;
	}

    /**
     * @param $bkmPublicKeyPath
     * @return boolean
     */
    public function verify($bkmPublicKeyPath)
    {
        $dataToBeVerified = $this->initializePaymentWSResponse->getToken() .
                            $this->initializePaymentWSResponse->getUrl() .
                            $this->initializePaymentWSResponse->getTimestamp();

        $decodedSignature = base64_decode($this->initializePaymentWSResponse->getSignature());

        return Certificate::verify($decodedSignature, $dataToBeVerified, $bkmPublicKeyPath);
    }
}