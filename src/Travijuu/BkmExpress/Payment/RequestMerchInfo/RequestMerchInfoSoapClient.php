<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use SoapClient;
use Exception;

class RequestMerchInfoSoapClient extends SoapClient
{

    public $requestMerchInfo;

    /**
     * Default class map for wsdl=>php
     * @access private
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
    public function __construct($wsdl, $options = []) {

        foreach(self::$classmap as $wsdlClassName => $phpClassName) {

            if(!isset($options['classmap'][$wsdlClassName])) {

                $options['classmap'][$wsdlClassName] = $phpClassName;
            }
        }

        parent::__construct($wsdl, $options);
    }

    /**
     * Checks if an argument list matches against a valid argument type list
     * @param array $arguments The argument list to check
     * @param array $validParameters A list of valid argument types
     * @return boolean true if arguments match against validParameters
     * @throws Exception invalid function signature message
     */
    public function _checkArguments($arguments, $validParameters) {
        $variables = "";
        foreach ($arguments as $arg) {
            $type = gettype($arg);
            if ($type == "object") {
                $type = get_class($arg);
            }
            $variables .= "(".$type.")";
        }
        if (!in_array($variables, $validParameters)) {
            throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
        }
        return true;
    }

    public function setParams(RequestMerchInfo $requestMerchInfo)
    {
        $this->requestMerchInfo = $requestMerchInfo;
    }

    /**
     * Service Call: requestMerchInfo
     * Parameter options:
     * (requestMerchInfo) parameters
     * @param mixed,... See function description for parameter options
     * @return RequestMerchInfoResponse
     * @throws Exception invalid function signature message
     */
    public function requestMerchInfo($mixed = null) {
        $validParameters = array(
            "(requestMerchInfo)",
        );
        $args = [$this->requestMerchInfo];
        //$this->_checkArguments($args, $validParameters);
        return $this->__soapCall("requestMerchInfo", $args);
    }
}