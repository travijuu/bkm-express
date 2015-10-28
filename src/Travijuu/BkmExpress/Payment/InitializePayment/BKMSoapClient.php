<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use SoapClient;

class BKMSoapClient extends SoapClient
{

	public $initializePayment;

	private static $classmap = array(
		'initializePayment'           => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePayment',
		'initializePaymentWSRequest'  => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentWSRequest',
		'bank'                        => 'Travijuu\BkmExpress\Common\Bank',
		'bin'                         => 'Travijuu\BkmExpress\Common\Bin',
		'installment'                 => 'Travijuu\BkmExpress\Common\Installment',
		'initializePaymentResponse'   => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentResponse',
		'initializePaymentWSResponse' => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentWSResponse',
		'result'                      => 'Travijuu\BkmExpress\Common\Result',
	);

	public function __construct($wsdl, $options = []) {

        foreach(self::$classmap as $wsdlClassName => $phpClassName) {

		    if(! isset($options['classmap'][$wsdlClassName])) {

		        $options['classmap'][$wsdlClassName] = $phpClassName;
		    }
		}

		parent::__construct($wsdl, $options);
	}

	public function setParams($initializePayment)
	{
		$this->initializePayment = $initializePayment;
	}

    /**
     * Service Call: initializePayment
     *
     * @return InitializePaymentResponse
     */
	public function initializePayment()
	{
		return $this->__soapCall('initializePayment', [$this->initializePayment]);
	}
}