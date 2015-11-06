<?php
namespace Travijuu\BkmExpress\Payment\RequestMerchInfo;

use Travijuu\BkmExpress\Payment\AbstractWSResponse;

class RequestMerchInfoWSResponse extends AbstractWSResponse
{

    /**
     * @var string
     */
    private $t;
    /**
     * @var string
     */
    private $posUrl;
    /**
     * @var string
     */
    private $posUid;
    /**
     * @var string
     */
    private $posPwd;
    /**
     * @var boolean
     */
    private $s3Dauth;
    /**
     * @var string
     */
    private $mpiUrl;
    /**
     * @var string
     */
    private $mpiUid;
    /**
     * @var string
     */
    private $mpiPwd;
    /**
     * @var string
     */
    private $md;
    /**
     * @var string
     */
    private $xid;
    /**
     * @var boolean
     */
    private $s3DFDec;
    /**
     * @var string
     */
    private $cIp;
    /**
     * @var string
     */
    private $extra;
    /**
     * @var string
     */
    private $ts;
    /**
     * @var string
     */
    private $s;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->t;
    }

    /**
     * @param string $t
     */
    public function setToken($t)
    {
        $this->t = $t;
    }

    /**
     * @return string
     */
    public function getPosUrl()
    {
        return $this->posUrl;
    }

    /**
     * @param string $posUrl
     */
    public function setPosUrl($posUrl)
    {
        $this->posUrl = $posUrl;
    }

    /**
     * @return string
     */
    public function getPosUid()
    {
        return $this->posUid;
    }

    /**
     * @param string $posUid
     */
    public function setPosUid($posUid)
    {
        $this->posUid = $posUid;
    }

    /**
     * @return string
     */
    public function getPosPwd()
    {
        return $this->posPwd;
    }

    /**
     * @param string $posPwd
     */
    public function setPosPwd($posPwd)
    {
        $this->posPwd = $posPwd;
    }

    /**
     * @return boolean
     */
    public function isS3Dauth()
    {
        return $this->s3Dauth;
    }

    /**
     * @param boolean $s3Dauth
     */
    public function setS3Dauth($s3Dauth)
    {
        $this->s3Dauth = $s3Dauth;
    }

    /**
     * @return string
     */
    public function getMpiUrl()
    {
        return $this->mpiUrl;
    }

    /**
     * @param string $mpiUrl
     */
    public function setMpiUrl($mpiUrl)
    {
        $this->mpiUrl = $mpiUrl;
    }

    /**
     * @return string
     */
    public function getMpiUid()
    {
        return $this->mpiUid;
    }

    /**
     * @param string $mpiUid
     */
    public function setMpiUid($mpiUid)
    {
        $this->mpiUid = $mpiUid;
    }

    /**
     * @return string
     */
    public function getMpiPwd()
    {
        return $this->mpiPwd;
    }

    /**
     * @param string $mpiPwd
     */
    public function setMpiPwd($mpiPwd)
    {
        $this->mpiPwd = $mpiPwd;
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
     */
    public function setMd($md)
    {
        $this->md = $md;
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
     */
    public function setXid($xid)
    {
        $this->xid = $xid;
    }

    /**
     * @return boolean
     */
    public function isS3DFDec()
    {
        return $this->s3DFDec;
    }

    /**
     * @param boolean $s3DFDec
     */
    public function setS3DFDec($s3DFDec)
    {
        $this->s3DFDec = $s3DFDec;
    }

    /**
     * @return string
     */
    public function getCIp()
    {
        return $this->cIp;
    }

    /**
     * @param string $cIp
     */
    public function setCIp($cIp)
    {
        $this->cIp = $cIp;
    }

    /**
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param string $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->ts;
    }

    /**
     * @param string $ts
     */
    public function setTimestamp($ts)
    {
        $this->ts = $ts;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->s;
    }

    /**
     * @param string $s
     */
    public function setSignature($s)
    {
        $this->s = $s;
    }
}