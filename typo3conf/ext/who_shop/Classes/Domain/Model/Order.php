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
 * Class Order
 * @package WHO\WhoShop\Domain\Model
 */
class Order extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var int
	 */
	protected $userId = 0;

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
	 * @lazy
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
		$this->orderItem = new \WHO\WhoShop\Domain\Model\OrderItem();
	}

	/**
	 * @param OrderItem $orderItem
	 * @return void
	 */
	public function addOrderItem(\WHO\WhoShop\Domain\Model\OrderItem $orderItem) {
		$this->orderItem->attach($orderItem);
	}

	/**
	 * @param OrderItem $orderItemToRemove
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
	 * @return int
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @param int $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

}
