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

/**
 * Class Basket
 * @package WHO\WhoShop\Domain\Model
 */
class Basket extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * orderItem
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<WHO\WhoShop\Domain\Model\BasketEntry>
	 * @lazy
	 */
	protected $orderItem = NULL;

	/**
	 * @var int
	 */
	protected $userId = 0;

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
		$this->orderItem = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @param $orderItem
	 */
	public function addOrderItem($orderItem) {
		$this->orderItem->attach($orderItem);
	}

	/**
	 * @param $orderItemToRemove
	 */
	public function removeOrderItem($orderItemToRemove) {
		$this->orderItem->detach($orderItemToRemove);
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getOrderItem()
	{
		return $this->orderItem;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $orderItem
	 */
	public function setOrderItem($orderItem)
	{
		$this->orderItem = $orderItem;
	}
}