<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

use Travijuu\BkmExpress\Payment\AbstractWSResponse;

class InitializePaymentWSResponse extends AbstractWSResponse
{
	/**
	 * @access public
	 * @var string
	 */
	public $t;
	/**
	 * @access public
	 * @var string
	 */
	public $url;
	/**
	 * @access public
	 * @var string
	 */
	public $ts;
	/**
	 * @access public
	 * @var string
	 */
	public $s;

	public function getToken()
	{
		return $this->t;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getTimestamp()
	{
		return $this->ts;
	}

	public function getSignature()
	{
		return $this->s;
	}

	public function getMessage()
	{
		return $this->result->getMessage();
	}
}