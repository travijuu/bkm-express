<?php
namespace Travijuu\BkmExpress\Common;

use Travijuu\BkmExpress\Exception\UnexpectedDataType;
use Travijuu\BkmExpress\Exception\UnexpectedInstance;

class Bank
{
	
	/**
	 * @access private
	 * @var string
	 */
	private $id;
	/**
	 * @access private
	 * @var string
	 */
	private $name;
	/**
	 * @access private
	 * @var string
	 */
	private $expBank;
	/**
	 * @access private
	 * @var Bin
	 */
	private $bins = [];
	/**
	 * @access private
	 * @var bin[]
	 */
	private $bin;

    public function getId()
    {
        return $this->id;
    }

	public function setId($id)
	{
		$this->id = $id;

        return $this;
	}

    public function getName()
    {
        return $this->name;
    }

	public function setName($name)
	{
		$this->name = $name;

        return $this;
	}

    public function getDescription()
    {
        return $this->expBank;
    }

	public function setDescription($description)
	{
		$this->expBank = $description;

        return $this;
	}

    public function getBins()
    {
        return $this->bins;
    }

	public function setBins($bins) 
	{
		if (! is_array($bins)) {
			
			throw new UnexpectedDataType("Bins should be array");
		}

		$this->bins = [];

		foreach ($bins as $bin) {
			
			$this->addBin($bin);
		}

        return $this;
	}

	public function addBin($bin)
	{
		if (! $bin instanceof Bin) {
			
			throw new UnexpectedInstance("Should be instance of Bin");
		}

		array_push($this->bins, $bin);

        return $this;
	}
}

