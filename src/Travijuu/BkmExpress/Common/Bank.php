<?php
namespace Travijuu\BkmExpress\Common;

use Travijuu\BkmExpress\Exception\UnexpectedDataType;
use Travijuu\BkmExpress\Exception\UnexpectedInstance;

class Bank
{
	
	/**
	 * @var string
	 */
	private $id;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $expBank;
	/**
	 * @var array|Bin
	 */
	private $bins = [];


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
	{
		$this->id = $id;

        return $this;
	}

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
	{
		$this->name = $name;

        return $this;
	}

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->expBank;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
	{
		$this->expBank = $description;

        return $this;
	}

    /**
     * @return array|Bin
     */
    public function getBins()
    {
        return $this->bins;
    }

    /**
     * @param $bins
     * @return $this
     * @throws UnexpectedDataType
     * @throws UnexpectedInstance
     */
    public function setBins($bins)
	{
		if (! is_array($bins)) {
			throw new UnexpectedDataType("Bins should be an array");
		}

		$this->bins = [];

		foreach ($bins as $bin) {
			$this->addBin($bin);
		}

        return $this;
	}

    /**
     * @param $bin
     * @return $this
     * @throws UnexpectedInstance
     */
    public function addBin($bin)
	{
		if (! $bin instanceof Bin) {
			throw new UnexpectedInstance("Should be instance of Bin");
		}

		array_push($this->bins, $bin);

        return $this;
	}
}

