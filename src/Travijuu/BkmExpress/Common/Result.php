<?php
namespace Travijuu\BkmExpress\Common;

class Result
{
	
	/**
	 * @access private
	 * @var integer
	 */
	private $resultCode;
	/**
	 * @access private
	 * @var string
	 */
	private $resultMsg;
	/**
	 * @access private
	 * @var string
	 */
	private $resultDet;

    public function __construct($resultCode, $resultMsg, $resultDet = '')
    {
        $this->resultCode = $resultCode;
        $this->resultMsg  = $resultMsg;
        $this->resultDet  = $resultDet;
    }

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

    public static function build($key)
    {
        $responseCode = MerchantWSResponseCode::$$key;
        return new Result($responseCode['code'], $responseCode['message']);
    }
}