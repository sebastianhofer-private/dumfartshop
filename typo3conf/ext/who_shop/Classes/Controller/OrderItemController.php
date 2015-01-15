<?php
namespace WHO\WhoShop\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 ***************************************************************/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class OrderItemController
 * @package WHO\WhoShop\Controller
 */
class OrderItemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * orderItemRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\OrderItemRepository
	 * @inject
	 */
	protected $orderItemRepository = NULL;

	/**
	 * productRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository = NULL;

	/**
	 * sessionHandler
	 *
	 * @var \WHO\WhoShop\Utility\BasketHandler
	 * @inject
	 */
	protected $basketHandler = NULL;

	/**
	 * basketList action
	 */
	public function basketListAction() {
		$this->view->assignMultiple(
			array(
				'products' => $this->productRepository->findByUidList(array_keys($this->basketHandler->getOrder())),
				'basket' => $this->basketHandler->getOrder(),
				'userIsLoggedIn' => $this->basketHandler->loginCheck()
			)
		);
	}
}