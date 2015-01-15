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
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * sub title
	 * @var string
	 */
	protected $subTitle = '';

	/**
	 * publishing number
	 * @var string
	 */
	protected $publishingNumber = '';

    /**
     *
     * @var float
     */
	protected $price = 0.0;

	/**
	 * sys_categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\Category>
	 * @lazy
	 */
	protected $categories = NULL;

	/**
	 * image
	 * 
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image = NULL;

	/**
	 * tracks
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\Track>
	 */
	protected $tracks = Null;

	/**
	 * additional information
	 * @var string
	 */
	protected $additionalInformation = '';

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a
	 *
	 * @param  $categories
	 * @return void
	 */
	public function addCategories($categories) {
		$this->categories->attach($categories);
	}

	/**
	 * Removes a
	 *
	 * @param $categoriesToRemove The  to be removed
	 * @return void
	 */
	public function removeCategories($categoriesToRemove) {
		$this->categories->detach($categoriesToRemove);
	}

	/**
	 * @param $tracks
	 */
	public function addTracks($tracks) {
		$this->categories->attach($tracks);
	}

	/**
	 * @param $tracksToRemove
	 */
	public function removeTracks($tracksToRemove) {
		$this->categories->detach($tracksToRemove);
	}

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
     * Gets the sub title.
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }
    
    /**
     * Sets the sub title.
     *
     * @param string $subTitle the sub  title
     *
     * @return self
     */
    protected function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Gets the publishing number.
     *
     * @return string
     */
    public function getPublishingNumber()
    {
        return $this->publishingNumber;
    }
    
    /**
     * Sets the publishing number.
     *
     * @param string $publishingNumber the publishing  number
     *
     * @return self
     */
    protected function setPublishingNumber($publishingNumber)
    {
        $this->publishingNumber = $publishingNumber;

        return $this;
    }

    /**
     * Gets the price.
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Sets the price.
     *
     * @param integer $price the price 
     *
     * @return self
     */
    protected function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Gets the sys_categories.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\Category
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    /**
     * Sets the sys_categories.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $categories
     * @return $this
     */
    protected function setCategories(\TYPO3\CMS\Extbase\Domain\Model\Category $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Gets the image.
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Sets the image.
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image the image 
     *
     * @return self
     */
    protected function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;

        return $this;
    }

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getTracks()
	{
		return $this->tracks;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $tracks
	 */
	public function setTracks($tracks)
	{
		$this->tracks = $tracks;
	}



	/**
	 * Gets the additional information.
	 *
	 * @return string
	 */
	public function getAdditionalInformation()
	{
		return $this->additionalInformation;
	}

	/**
	 * Sets the additional information.
	 *
	 * @param string $additional_information the additional  information
	 *
	 * @return self
	 */
	protected function setAdditionalInformation($additionalInformation)
	{
		$this->additionalInformation = $additionalInformation;

		return $this;
	}
}