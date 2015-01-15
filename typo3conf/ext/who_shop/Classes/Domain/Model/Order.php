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
 * Class Order
 * @package WHO\WhoShop\Domain\Model
 */
class Order extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * fe_user relation
	 *
	 * @var \WHO\WhoShop\Domain\Model\User
	 */
	protected $user = NULL;

	/**
	 * @var int
	 */
	protected $orderId = 0;

	/**
	 * @var int
	 */
	protected $orderDate = 0;

	/**
	 * @var int
	 */
	protected $state = 0;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\OrderItem>
	 * @cascade remove
	 */
	protected $orderItem = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->orderItem = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a OrderItem
	 *
	 * @param \WHO\WhoShop\Domain\Model\OrderItem $orderItem
	 * @return void
	 */
	public function addOrderItem(\WHO\WhoShop\Domain\Model\OrderItem $orderItem) {
		$this->orderItem->attach($orderItem);
	}

	/**
	 * Removes a OrderItem
	 * @param \WHO\WhoShop\Domain\Model\OrderItem $orderItemToRemove
	 * @return void
	 */
	public function removeOrderItem(\WHO\WhoShop\Domain\Model\OrderItem $orderItemToRemove) {
		$this->orderItem->detach($orderItemToRemove);
	}

	/**
	 * @return int
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}

	/**
	 * @param int $orderId
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;
	}

	/**
	 * Returns the OrderItem
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\OrderItem> $orderItem
	 */
	public function getOrderItem()
	{
		return $this->orderItem;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WHO\WhoShop\Domain\Model\OrderItem> $orderItem
	 * @return void
	 */
	public function setOrderItem($orderItem)
	{
		$this->orderItem = $orderItem;
	}

	/**
	 * @return int
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param int $state
	 */
	public function setState($state)
	{
		$this->state = $state;
	}

	/**
	 * Returns the user
	 *
	 * @return \WHO\WhoShop\Domain\Model\User $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 *
	 * @param \WHO\WhoShop\Domain\Model\User $user
	 * @return void
	 */
	public function setUser(\WHO\WhoShop\Domain\Model\User $user) {
		$this->user = $user;
	}

}
