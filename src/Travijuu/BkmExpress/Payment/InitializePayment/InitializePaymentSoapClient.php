<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use SoapClient;
use Travijuu\BkmExpress\Exception\UnexpectedInstance;

class InitializePaymentSoapClient extends SoapClient
{

    /**
     * @var InitializePayment
     */
    public $initializePayment;

    /**
     * class mapping array for wsdl
     * @var array
     */
    private static $classmap = [
        'initializePayment'           => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePayment',
        'initializePaymentWSRequest'  => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentWSRequest',
        'bank'                        => 'Travijuu\BkmExpress\Common\Bank',
        'bin'                         => 'Travijuu\BkmExpress\Common\Bin',
        'installment'                 => 'Travijuu\BkmExpress\Common\Installment',
        'initializePaymentResponse'   => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentResponse',
        'initializePaymentWSResponse' => 'Travijuu\BkmExpress\Payment\InitializePayment\InitializePaymentWSResponse',
        'result'                      => 'Travijuu\BkmExpress\Common\Result',
    ];

    /**
     * default construct for mapping given classes with the wsdl
     * @param string $wsdl WSDL location for this service
     * @param array $options Options for the SoapClient
     */
    public function __construct($wsdl, $options = [])
    {
        foreach(self::$classmap as $wsdlClassName => $phpClassName) {
            if(! isset($options['classmap'][$wsdlClassName])) {
                $options['classmap'][$wsdlClassName] = $phpClassName;
            }
        }

        parent::__construct($wsdl, $options);
    }

    /**
     * @param $initializePayment
     * @throws UnexpectedInstance
     */
    public function setParams($initializePayment)
    {
        if (! $initializePayment instanceof InitializePayment) {
            throw new UnexpectedInstance("Should be instance of InitializePayment");
        }

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