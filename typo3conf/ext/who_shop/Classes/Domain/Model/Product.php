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
	protected $sub_title = '';

	/**
	 * publishing number
	 * @var string
	 */
	protected $publishing_number = '';

	/**
	 * price
	 * 
	 * @var integer
	 */
	protected $price = 0;

	/**
	 * sys_categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
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
	 * @var integer
	 */
	protected $tracks = 0;

	/**
	 * additional information
	 * @var string
	 */
	protected $additional_information = '';

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
        return $this->sub_title;
    }
    
    /**
     * Sets the sub title.
     *
     * @param string $sub_title the sub  title 
     *
     * @return self
     */
    protected function setSubTitle($sub_title)
    {
        $this->sub_title = $sub_title;

        return $this;
    }

    /**
     * Gets the publishing number.
     *
     * @return string
     */
    public function getPublishingNumber()
    {
        return $this->publishing_number;
    }
    
    /**
     * Sets the publishing number.
     *
     * @param string $publishing_number the publishing  number 
     *
     * @return self
     */
    protected function setPublishingNumber($publishing_number)
    {
        $this->publishing_number = $publishing_number;

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
     * Gets the tracks.
     *
     * @return integer
     */
    public function getTracks()
    {
        return $this->tracks;
    }
    
    /**
     * Sets the tracks.
     *
     * @param integer $tracks the tracks 
     *
     * @return self
     */
    protected function setTracks($tracks)
    {
        $this->tracks = $tracks;

        return $this;
    }

	/**
	 * Gets the additional information.
	 *
	 * @return string
	 */
	public function getAdditionalInformation()
	{
		return $this->additional_information;
	}

	/**
	 * Sets the additional information.
	 *
	 * @param string $additional_information the additional  information
	 *
	 * @return self
	 */
	protected function setAdditionalInformation($additional_information)
	{
		$this->additional_information = $additional_information;

		return $this;
	}
}