<?php
namespace Travijuu\BkmExpress\Payment;

abstract class AbstractWSResponse
{

    /**
     * @var \Travijuu\BkmExpress\Common\Result;
     */
    public $result;


    /**
     * @return \Travijuu\BkmExpress\Common\Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }
}