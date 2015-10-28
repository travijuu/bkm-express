<?php
namespace Travijuu\BkmExpress\Common;

class VirtualPos
{

    /**
     * @access private
     * @var string
     */
    private $posUrl;

    /**
     * @access private
     * @var string
     */
    private $posUid;

    /**
     * @access private
     * @var string
     */
    private $posPwd;

    /**
     * @access private
     * @var boolean
     */
    private $is3ds;

    /**
     * @access private
     * @var string
     */
    private $mpiUrl;

    /**
     * @access private
     * @var string
     */
    private $mpiUid;

    /**
     * @access private
     * @var string
     */
    private $mpiPwd;

    /**
     * @access private
     * @var string
     */
    private $md;

    /**
     * @access private
     * @var string
     */
    private $xid;

    /**
     * @access private
     * @var boolean
     */
    private $is3dsFDec;

    /**
     * @access private
     * @var string
     */
    private $cIp;

    /**
     * @access private
     * @var string
     */
    private $extra;

    /**
     * @return string
     */
    public function getPosUrl()
    {
        return $this->posUrl;
    }

    /**
     * @param string $posUrl
     *
     * @return $this
     */
    public function setPosUrl($posUrl)
    {
        $this->posUrl = $posUrl;

        return $this;
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
     *
     * @return $this
     */
    public function setPosUid($posUid)
    {
        $this->posUid = $posUid;

        return $this;
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
     *
     * @return $this
     */
    public function setPosPwd($posPwd)
    {
        $this->posPwd = $posPwd;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIs3ds()
    {
        return $this->is3ds;
    }

    /**
     * @param boolean $is3ds
     *
     * @return $this
     */
    public function setIs3ds($is3ds)
    {
        $this->is3ds = $is3ds;

        return $this;
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
     *
     * @return $this
     */
    public function setMpiUrl($mpiUrl)
    {
        $this->mpiUrl = $mpiUrl;

        return $this;
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
     *
     * @return $this
     */
    public function setMpiUid($mpiUid)
    {
        $this->mpiUid = $mpiUid;

        return $this;
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
     *
     * @return $this
     */
    public function setMpiPwd($mpiPwd)
    {
        $this->mpiPwd = $mpiPwd;

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
     * @return $this
     */
    public function setMd($md)
    {
        $this->md = $md;

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
     * @return $this
     */
    public function setXid($xid)
    {
        $this->xid = $xid;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIs3dsFDec()
    {
        return $this->is3dsFDec;
    }

    /**
     * @param boolean $is3dsFDec
     *
     * @return $this
     */
    public function setIs3dsFDec($is3dsFDec)
    {
        $this->is3dsFDec = $is3dsFDec;

        return $this;
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
     *
     * @return $this
     */
    public function setCIp($cIp)
    {
        $this->cIp = $cIp;

        return $this;
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
     *
     * @return $this
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }
}