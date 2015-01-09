<?php 

namespace WHO\WhoShop\Domain\Model;

/***************************************************************
 *
 * Copyright notice
 *
 * (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 * All rights reserved
 * 
 ***************************************************************/

/**
 * Track
 */
class Track extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 * @var string
	 */
	protected $title;

	/**
	 * authority
	 * @var string
	 */
	protected $authority;

	/**
	 * hasExample
	 * @var boolean
	 */
	protected $hasExample;

	/**
	 * example
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $example = NULL;

	/**
	 * @var int
	 */
	protected $sorting = 0;

	/**
	 * Gets the title.
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Sets the title.
	 *
	 * @param string $title the title 
	 *
	 * @return self
	 */
	protected function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Gets the trackNumber.
	 *
	 * @return int
	 */
	public function getTrackNumber()
	{
		return $this->trackNumber;
	}
	
	/**
	 * Sets the trackNumber.
	 *
	 * @param int $trackNumber the track number 
	 *
	 * @return self
	 */
	protected function setTrackNumber($trackNumber)
	{
		$this->trackNumber = $trackNumber;

		return $this;
	}

	/**
	 * Gets the authority.
	 *
	 * @return string
	 */
	public function getAuthority()
	{
		return $this->authority;
	}
	
	/**
	 * Sets the authority.
	 *
	 * @param string $authority the authority 
	 *
	 * @return self
	 */
	protected function setAuthority($authority)
	{
		$this->authority = $authority;

		return $this;
	}

	/**
	 * Gets the hasExample.
	 *
	 * @return boolean
	 */
	public function getHasExample()
	{
		return $this->hasExample;
	}
	
	/**
	 * Sets the hasExample.
	 *
	 * @param boolean $hasExample the has example 
	 *
	 * @return self
	 */
	protected function setHasExample($hasExample)
	{
		$this->hasExample = $hasExample;

		return $this;
	}

	/**
	 * Gets the example.
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getExample()
	{
		return $this->example;
	}
	
	/**
	 * Sets the example.
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $example the example 
	 *
	 * @return self
	 */
	protected function setExample(\TYPO3\CMS\Extbase\Domain\Model\FileReference $example)
	{
		$this->example = $example;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSorting()
	{
		return $this->sorting;
	}

	/**
	 * @param int $sorting
	 */
	public function setSorting($sorting)
	{
		$this->sorting = $sorting;
	}


}

 ?>