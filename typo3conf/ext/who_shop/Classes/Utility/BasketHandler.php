<?php
namespace WHO\WhoShop\Utility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 ***************************************************************/
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class BasketHandler
 * @package WHO\WhoShop\Utility
 */
class BasketHandler implements SingletonInterface {

	/**
	 * sessionHandler
	 *
	 * @var \WHO\WhoShop\Utility\ShopSessionHandler
	 */
	protected $shopSessionHandler = NULL;

	/**
	 * @var \WHO\WhoShop\Domain\Model\Order
	 */
	protected $defaultOrderObject = NULL;

	/**
	 * @var string
	 */
	protected $defaultOrderObjectKey = '';

	/**
	 * @var bool
	 */
	protected $articleFound = FALSE;


	/**
	 * @param string $defaultOrderObjectKey
	 */
	public function __construct($defaultOrderObjectKey = 'order') {

		// create shopSessionHandler object
		$this->shopSessionHandler = new \WHO\WhoShop\Utility\ShopSessionHandler();

		// set default key for order object
		$this->defaultOrderObjectKey = $defaultOrderObjectKey;

		// add order object by default if not exist
		if(!$this->shopSessionHandler->restoreFromSession($this->defaultOrderObjectKey)){
			$this->defaultOrderObject = array();
			$this->shopSessionHandler->writeToSession($this->defaultOrderObject, $this->defaultOrderObjectKey);
		}
	}

	/**
	 * @param int $uid
	 * @param int $orderSize
	 * @param int $orderValue
	 * @return bool
	 */
	public function addItemToOrder($uid = 0, $orderSize = 0, $orderValue = 0) {
		$returnValue = FALSE;

		if(!$this->findItemInOrder($uid)['productFound']){
			$itemArray = array(
				'orderSize' => $orderSize,
				'orderValue' => $orderSize * $orderValue
			);

			$currentOrder = $this->getOrder();
			$currentOrder[$uid] = $itemArray;
			$this->updateOrder($currentOrder);
			$returnValue = TRUE;
		}

		return $returnValue;
	}

	/**
	 * @param int $uid
	 * @return array
	 */
	public function findItemInOrder($uid = 0) {
		$returnArray = array(
			'foundItem' => NULL,
			'productFound' => FALSE
		);
		$currentOrder = $this->getOrder();

		if($returnArray['foundItem'] = $currentOrder[$uid]){
			$returnArray['productFound'] = TRUE;
		}

		return $returnArray;
	}

	/**
	 * @param int $uid
	 * @return bool
	 */
	public function removeItemFromOrder($uid = 0) {
		$returnValue = FALSE;
		if($this->findItemInOrder($uid)){
			$currentOrder = $this->getOrder();
			unset($currentOrder[$uid]);
			$this->updateOrder($currentOrder);
			$returnValue = TRUE;
		}
		return $returnValue;
	}

	/**
	 * @return mixed
	 */
	public function getOrder() {
		return $this->shopSessionHandler->restoreFromSession($this->defaultOrderObjectKey);
	}

	/**
	 * @param array $order
	 * @return $this
	 */
	public function updateOrder($order = array()) {
		$this->shopSessionHandler->writeToSession($order, $this->defaultOrderObjectKey);
		return $this;
	}

	/**
	 * @return bool
	 */
	public function loginCheck(){
		return $this->shopSessionHandler->testUser();
	}
}