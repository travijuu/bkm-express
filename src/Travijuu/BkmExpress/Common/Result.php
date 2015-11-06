<?php
namespace Travijuu\BkmExpress\Common;

class Result
{
    
    /**
     * @var integer
     */
    private $resultCode;
    /**
     * @var string
     */
    private $resultMsg;
    /**
     * @var string
     */
    private $resultDet;

    public function __construct($resultCode, $resultMsg, $resultDet = '')
    {
        $this->resultCode = $resultCode;
        $this->resultMsg  = $resultMsg;
        $this->resultDet  = $resultDet;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->resultCode;
    }

    /**
     * @param int $resultCode
     *
     * @return $this
     */
    public function setCode($resultCode)
    {
        $this->resultCode = $resultCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->resultMsg;
    }

    /**
     * @param string $resultMsg
     *
     * @return $this
     */
    public function setMessage($resultMsg)
    {
        $this->resultMsg = $resultMsg;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->resultDet;
    }

    /**
     * @param string $resultDet
     *
     * @return $this
     */
    public function setDetail($resultDet)
    {
        $this->resultDet = $resultDet;

        return $this;
    }

    /**
     * @param $key
     * @return Result
     */
    public static function build($key)
    {
        $responseCode = MerchantWSResponseCode::$$key;
        return new Result($responseCode['code'], $responseCode['message']);
    }
}