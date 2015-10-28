<?php
namespace Travijuu\BkmExpress\Payment;

abstract class AbstractWSResponse
{

    /**
     * @var \Travijuu\BkmExpress\Common\Result;
     */
    public $result;

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }
}