<?php
namespace Travijuu\BkmExpress\Common;

class Installment
{

    /**
     * @access private
     * @var integer
     */
    private $nofInst;
    /**
     * @access private
     * @var string
     */
    private $amountInst;
    /**
     * @access private
     * @var string
     */
    private $cAmount;
    /**
     * @access private
     * @var string
     */
    private $tAmount;
    /**
     * @access private
     * @var boolean
     */
    private $cPaid1stInst;
    /**
     * @access private
     * @var string
     */
    private $expInst;

    public function setInstallmentAmount($amount)
    {
        $this->amountInst = number_format($amount, 2, ",", "");
        return $this;
    }

    public function setCargoAmount($amount)
    {
        $this->cAmount = number_format($amount, 2, ",", "");
        return $this;
    }

    public function setPayCargoAtFirstInstallment($value = false)
    {
        $this->cPaid1stInst = $value;
        return $this;
    }

    public function setDescription($description)
    {
        $this->expInst = $description;
        return $this;
    }

    public function setInstallment($installment)
    {
        $this->nofInst = $installment;
        $this->updateInstallmentAmount();
        return $this;
    }

    public function setAmount($amount)
    {
        $this->tAmount = number_format($amount, 2, ",", "");
        $this->updateInstallmentAmount();
        return $this;
    }

    private function updateInstallmentAmount()
    {
        if ((! $this->amountInst) && $this->nofInst && $this->tAmount) {

            $this->setInstallmentAmount($this->getTotalAmount(false) / $this->nofInst);
        }
    }

    public function getInstallment()
    {
        return $this->nofInst;
    }

    public function getInstallmentAmount($asString = true)
    {
        return $asString ? $this->amountInst : floatval(str_replace(',', '.', $this->amountInst));
    }

    public function getCargoAmount($asString = true)
    {
        return $asString ? $this->cAmount : floatval(str_replace(',', '.', $this->cAmount));
    }

    public function getTotalAmount($asString = true)
    {
        return $asString ? $this->tAmount : floatval(str_replace(',', '.', $this->tAmount));
    }

    public function getPayCargoAtFirstInstallment()
    {
        return $this->cPaid1stInst ? 'true' : 'false';
    }

    public function getDescription()
    {
        return $this->expInst;
    }
}