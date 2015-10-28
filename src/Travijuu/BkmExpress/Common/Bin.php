<?php
namespace Travijuu\BkmExpress\Common;

use Travijuu\BkmExpress\Exception\UnexpectedDataType;
use Travijuu\BkmExpress\Exception\UnexpectedInstance;

class Bin
{
	
	private $value;

	private $insts = [];

	private $inst;

    public function getValue()
    {
        return $this->value;
    }

	public function setValue($value)
	{
		$this->value = $value;

        return $this;
	}

    public function getInstallments()
    {
        return $this->insts;
    }

	public function setInstallments($installments)
	{
		if (! is_array($installments)) {
			
			throw new UnexpectedDataType("Installments should be array");
		}

		$this->insts = [];

		foreach ($installments as $installment) {
			
			$this->addInstallment($installment);
		}

        return $this;
	}

	public function addInstallment($installment)
	{
		if (! $installment instanceof Installment) {

			throw new UnexpectedInstance("Should be instance of Installment");
		}

		array_push($this->insts, $installment);

        return $this;
	}
}