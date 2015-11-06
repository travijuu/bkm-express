<?php
namespace Travijuu\BkmExpress\Common;

use Travijuu\BkmExpress\Exception\UnexpectedDataType;
use Travijuu\BkmExpress\Exception\UnexpectedInstance;

class Bin
{

    /**
     * @var string
     */
    private $value;

    /**
     * @var array|Installment
     */
    private $insts = [];


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return array|Installment
     */
    public function getInstallments()
    {
        return $this->insts;
    }

    /**
     * @param $installments
     * @return $this
     * @throws UnexpectedDataType
     * @throws UnexpectedInstance
     */
    public function setInstallments($installments)
    {
        if (! is_array($installments)) {
            throw new UnexpectedDataType("Installments should be an array");
        }

        $this->insts = [];

        foreach ($installments as $installment) {
            $this->addInstallment($installment);
        }

        return $this;
    }

    /**
     * @param $installment
     * @return $this
     * @throws UnexpectedInstance
     */
    public function addInstallment($installment)
    {
        if (! $installment instanceof Installment) {
            throw new UnexpectedInstance("Should be instance of Installment");
        }

        array_push($this->insts, $installment);

        return $this;
    }
}