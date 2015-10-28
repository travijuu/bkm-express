<?php
namespace Travijuu\BkmExpress\Common;

use Travijuu\BkmExpress\Utility\Certificate;

/**
 * Class IncomingResult
 * @package Travijuu\BkmExpress\Common
 */
class IncomingResult
{

    /**
     * @var string
     */
    private $t;

    /**
     * @var string
     */
    private $r;

    /**
     * @var string
     */
    private $posRef;

    /**
     * @var string
     */
    private $ts;

    /**
     * @var string
     */
    private $s;

    /**
     * @var string
     */
    private $xid;

    /**
     * @var string
     */
    private $md;

    /**
     * @var string
     */
    private $pData;

    /**
     * @var string
     */
    private $eKey1;

    /**
     * @var string
     */
    private $eKey2;


    public function __construct($data)
    {
        $this->t      = array_get($data, 't', null);
        $this->r      = array_get($data, 'r', 0);
        $this->ts     = array_get($data, 'ts', null);
        $this->s      = array_get($data, 's', null);
        $this->xid    = array_get($data, 'xid', null);
        $this->md     = array_get($data, 'md', null);
        $this->pData  = array_get($data, 'pData', null);
        $this->eKey1  = array_get($data, 'eKey1', null);
        $this->eKey2  = array_get($data, 'eKey2', null);

        $this->posRef = $this->r ?
            array_get($data, 'posMessage', null) :
            array_get($data, 'posRef', null);
    }

    /**
     * @return string
     */
    public function getT()
    {
        return $this->t;
    }

    /**
     * @param string $t
     *
     * @return $this;
     */
    public function setT($t)
    {
        $this->t = $t;

        return $this;
    }

    /**
     * @return string
     */
    public function getR()
    {
        return $this->r;
    }

    /**
     * @param string $r
     *
     * @return $this;
     */
    public function setR($r)
    {
        $this->r = $r;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosRef()
    {
        return $this->success() ? htmlspecialchars_decode($this->posRef) : $this->posRef;
    }

    /**
     * @param string $posRef
     *
     * @return $this;
     */
    public function setPosRef($posRef)
    {
        $this->posRef = $posRef;

        return $this;
    }

    /**
     * @return string
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param string $ts
     *
     * @return $this;
     */
    public function setTs($ts)
    {
        $this->ts = $ts;

        return $this;
    }

    /**
     * @return string
     */
    public function getS()
    {
        return $this->s;
    }

    /**
     * @param string $s
     *
     * @return $this;
     */
    public function setS($s)
    {
        $this->s = $s;

        return $this;
    }

    /**
     * @return string
     */
    public function getXid()
    {
        return $this->xid;
    }

    /**
     * @param string $xid
     *
     * @return $this;
     */
    public function setXid($xid)
    {
        $this->xid = $xid;

        return $this;
    }

    /**
     * @return string
     */
    public function getMd()
    {
        return $this->md;
    }

    /**
     * @param string $md
     *
     * @return $this;
     */
    public function setMd($md)
    {
        $this->md = $md;

        return $this;
    }

    /**
     * @return string
     */
    public function getPData()
    {
        return $this->pData;
    }

    /**
     * @param string $pData
     *
     * @return $this;
     */
    public function setPData($pData)
    {
        $this->pData = $pData;

        return $this;
    }

    /**
     * @return string
     */
    public function getEKey1()
    {
        return $this->eKey1;
    }

    /**
     * @param string $eKey1
     *
     * @return $this;
     */
    public function setEKey1($eKey1)
    {
        $this->eKey1 = $eKey1;

        return $this;
    }

    /**
     * @return string
     */
    public function getEKey2()
    {
        return $this->eKey2;
    }

    /**
     * @param string $eKey2
     *
     * @return $this;
     */
    public function setEKey2($eKey2)
    {
        $this->eKey2 = $eKey2;

        return $this;
    }

    public function success()
    {
        return $this->r == 1;
    }

    public function verify($bkmPublicKeyPath)
    {
        $dataToBeVerified = $this->t . $this->pData . $this->eKey1 . $this->eKey2 . $this->ts;
        $decodedSignature = base64_decode($this->s);

        return Certificate::verify($decodedSignature, $dataToBeVerified, $bkmPublicKeyPath);
    }
}