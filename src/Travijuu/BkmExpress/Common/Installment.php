<?php
namespace Travijuu\BkmExpress\Common;

class Installment
{

    /**
     * @var integer
     */
    private $nofInst;
    /**
     * @var string
     */
    private $amountInst;
    /**
     * @var string
     */
    private $cAmount;
    /**
     * @var string
     */
    private $tAmount;
    /**
     * @var boolean
     */
    private $cPaid1stInst;
    /**
     * @var string
     */
    private $expInst;


    /**
     * @param $amount
     * @return $this
     */
    public function setInstallmentAmount($amount)
    {
        $this->amountInst = number_format($amount, 2, ",", "");
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
     * @param bool $value
     * @return $this
     */
    public function setPayCargoAtFirstInstallment($value = false)
    {
        $this->cPaid1stInst = $value;
        return $this;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->expInst = $description;
        return $this;
    }

    /**
     * @param $installment
     * @return $this
     */
    public function setInstallment($installment)
    {
        $this->nofInst = $installment;
        $this->updateInstallmentAmount();
        return $this;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->tAmount = number_format($amount, 2, ",", "");
        $this->updateInstallmentAmount();
        return $this;
    }

    /**
     *
     */
    private function updateInstallmentAmount()
    {
        if ((! $this->amountInst) && $this->nofInst && $this->tAmount) {

            $this->setInstallmentAmount($this->getTotalAmount(false) / $this->nofInst);
        }
    }

    /**
     * @return int
     */
    public function getInstallment()
    {
        return $this->nofInst;
    }

    /**
     * @param bool $asString
     * @return float|string
     */
    public function getInstallmentAmount($asString = true)
    {
        return $asString ? $this->amountInst : floatval(str_replace(',', '.', $this->amountInst));
    }

    /**
     * @param bool $asString
     * @return float|string
     */
    public function getCargoAmount($asString = true)
    {
        return $asString ? $this->cAmount : floatval(str_replace(',', '.', $this->cAmount));
    }

    /**
     * @param bool $asString
     * @return float|string
     */
    public function getTotalAmount($asString = true)
    {
        return $asString ? $this->tAmount : floatval(str_replace(',', '.', $this->tAmount));
    }

    /**
     * @return string
     */
    public function getPayCargoAtFirstInstallment()
    {
        return $this->cPaid1stInst ? 'true' : 'false';
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->expInst;
    }
}