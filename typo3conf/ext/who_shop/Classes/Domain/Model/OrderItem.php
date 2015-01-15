<?php
namespace WHO\WhoShop\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 ***************************************************************/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class OrderItem
 * @package WHO\WhoShop\Domain\Model
 */
class OrderItem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var int
	 */
	protected $orderSize = 0;

	/**
	 * product
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<WHO\WhoShop\Domain\Model\Product>
	 */
	protected $product = NULL;

	/**
	 * @var float
	 */
	protected $orderValue = 0.0;

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
		$this->product = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Product
	 *
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @return void
	 */
	public function addProduct(\WHO\WhoShop\Domain\Model\Product $product) {
		$this->product->attach($product);
	}

	/**
	 * Removes a Product
	 *
	 * @param \WHO\WhoShop\Domain\Model\Product $productToRemove The Product to be removed
	 * @return void
	 */
	public function removeProduct(\WHO\WhoShop\Domain\Model\Product $productToRemove) {
		$this->product->detach($productToRemove);
	}

	/**
	 * Returns the Product
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\Product> $product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Sets the Product
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\Product> $product
	 * @return void
	 */
	public function setProduct(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $product) {
		$this->product = $product;
	}

	/**
	 * @return int
	 */
	public function getOrderSize()
	{
		return $this->orderSize;
	}

	/**
	 * @param int $orderSize
	 */
	public function setOrderSize($orderSize)
	{
		$this->orderSize = $orderSize;
	}

	/**
	 * @return int
	 */
	public function getorderValue()
	{
		return $this->orderValue;
	}

	/**
	 * @param int $orderValue
	 */
	public function setorderValue($orderValue)
	{
		$this->orderValue = $orderValue;
	}


}