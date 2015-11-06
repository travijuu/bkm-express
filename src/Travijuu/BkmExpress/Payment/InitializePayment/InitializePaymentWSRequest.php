<?php
namespace Travijuu\BkmExpress\Payment\InitializePayment;

class InitializePaymentWSRequest
{

	/**
	 * @var string
	 */
	private $mId;
	/**
	 * @var string
	 */
	private $sUrl;
	/**
	 * @var string
	 */
	private $cUrl;
	/**
	 * @var string
	 */
	private $sAmount;
	/**
	 * @var string
	 */
	private $cAmount;
	/**
	 * @var Bank
	 */
	private $instOpts = [];
	/**
	 * @var bank[]
	 */
	private $bank;
	/**
	 * @var string
	 */
	private $ts;
	/**
	 * @var string
	 */
	private $s;

    /**
     * @param $mId
     * @return $this
     */
    public function setMerchantId($mId)
	{
		$this->mId = $mId;

        return $this;
	}

    /**
     * @param $url
     * @return $this
     */
    public function setSuccessUrl($url)
	{
		$this->sUrl = $url;

        return $this;
	}

    /**
     * @param $url
     * @return $this
     */
    public function setCancelUrl($url)
	{
		$this->cUrl = $url;

        return $this;
	}

    /**
     * @param $amount
     * @return $this
     */
    public function setSaleAmount($amount)
	{
		$this->sAmount = number_format($amount, 2, ",", "");

        return $this;
	}

    /**
     * @param $amount
     * @return $this
     */
    public function setCargoAmount($amount)
	{
		$this->cAmount = number_format($amount, 2, ",", "");

        return $this;
	}

    /**
     * @param $banks
     * @return $this
     */
    public function setBanks($banks)
	{
		$this->instOpts = $banks;

        return $this;
	}

    /**
     * @param $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
	{
		$this->ts = $timestamp;

        return $this;
	}

    /**
     * @param $signature
     * @return $this
     */
    public function setSignature($signature)
	{
		$this->s = $signature;

        return $this;
	}

    /**
     * @return string
     */
    public function getDataToBeHashed()
	{
		$data = $this->mId . $this->sUrl . $this->cUrl . $this->sAmount . $this->cAmount;

		foreach ($this->instOpts as $bank) {
			
			$data .= $bank->getId() . $bank->getName() . $bank->getDescription();

			foreach ($bank->getBins() as $bin) {
				
				$data .= $bin->getValue();

				foreach ($bin->getInstallments() as $installment) {
					
					$data .= $installment->getInstallment() . $installment->getInstallmentAmount() .
                             $installment->getCargoAmount() . $installment->getTotalAmount() .
                             $installment->getPayCargoAtFirstInstallment() . $installment->getDescription();
				}
			}
		}

		$data .= $this->ts;
		
		return $data;
	}	
}