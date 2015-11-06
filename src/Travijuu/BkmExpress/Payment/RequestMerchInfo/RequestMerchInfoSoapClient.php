<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use SoapClient;
use Exception;

class RequestMerchInfoSoapClient extends SoapClient
{

    public $requestMerchInfo;

    /**
     * Default class map for wsdl -> php
     * @var array
     */
    private static $classmap = array(
        'requestMerchInfo'            => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfo',
        'requestMerchInfoWSRequest'   => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSRequest',
        'requestMerchInfoResponse'    => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoResponse',
        'requestMerchInfoWSResponse'  => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoWSResponse',
        'requestMerchInfoServiceImpl' => 'Travijuu\BkmExpress\Payment\RequestMerchInfo\RequestMerchInfoServer',
        'result'                      => 'Travijuu\BkmExpress\Common\Result',
    );

    /**
     * Constructor using wsdl location and options array
     * @param string $wsdl WSDL location for this service
     * @param array $options Options for the SoapClient
     */
    public function __construct($wsdl, $options = [])
    {
        foreach(self::$classmap as $wsdlClassName => $phpClassName) {
            if(!isset($options['classmap'][$wsdlClassName])) {
                $options['classmap'][$wsdlClassName] = $phpClassName;
            }
        }

        parent::__construct($wsdl, $options);
    }

    public function setParams(RequestMerchInfo $requestMerchInfo)
    {
        $this->requestMerchInfo = $requestMerchInfo;
    }

    /**
     * Service Call: requestMerchInfo
     * @param mixed,...
     * @return RequestMerchInfoResponse
     */
    public function requestMerchInfo($mixed = null)
    {
        return $this->__soapCall("requestMerchInfo", [$this->requestMerchInfo]);
    }
}