<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

class InitializePaymentWSRequest
{

	/**
	 * @access public
	 * @var string
	 */
	public $mId;
	/**
	 * @access public
	 * @var string
	 */
	public $sUrl;
	/**
	 * @access public
	 * @var string
	 */
	public $cUrl;
	/**
	 * @access public
	 * @var string
	 */
	public $sAmount;
	/**
	 * @access public
	 * @var string
	 */
	public $cAmount;
	/**
	 * @access public
	 * @var Bank
	 */
	public $instOpts = [];
	/**
	 * @access public
	 * @var bank[]
	 */
	public $bank;
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

	public function setMerchantId($mId)
	{
		$this->mId = $mId;

        return $this;
	}

	public function setSuccessUrl($url)
	{
		$this->sUrl = $url;

        return $this;
	}

	public function setCancelUrl($url)
	{
		$this->cUrl = $url;

        return $this;
	}

	public function setSaleAmount($amount)
	{
		$this->sAmount = number_format($amount, 2, ",", "");

        return $this;
	}

	public function setCargoAmount($amount)
	{
		$this->cAmount = number_format($amount, 2, ",", "");

        return $this;
	}

	public function setBanks($banks)
	{
		$this->instOpts = $banks;

        return $this;
	}

	public function setTimestamp($timestamp)
	{
		$this->ts = $timestamp;

        return $this;
	}

	public function setSignature($signature)
	{
		$this->s = $signature;

        return $this;
	}

	public function getDataToBeHashed()
	{
		$data = $this->mId . $this->sUrl . $this->cUrl . $this->sAmount . $this->cAmount;

		foreach ($this->instOpts as $bank) {
			
			$data .= $bank->getId() . $bank->getName() . $bank->getDescription();

			foreach ($bank->getBins() as $bin) {
				
				$data .= $bin->getValue();

				foreach ($bin->getInstallments() as $installment) {
					
					$data .= $installment->getInstallment() . $installment->getInstallmentAmount() . $installment->getCargoAmount() . $installment->getTotalAmount() . $installment->getPayCargoAtFirstInstallment() . $installment->getDescription();
				}
			}
		}

		$data .= $this->ts;
		
		return $data;
	}	
}