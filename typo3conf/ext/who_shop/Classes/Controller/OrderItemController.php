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
	 * orderRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\OrderRepository
	 * @inject
	 */
	protected $orderRepository = NULL;

	/**
	 * productRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository = NULL;

	/**
	 * frontendUserRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $frontendUserRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager = NULL;

	/**
	 * basketHandler
	 *
	 * @var \WHO\WhoShop\Utility\BasketHandler
	 * @inject
	 */
	protected $basketHandler = NULL;

	/**
	 * mailHandler
	 *
	 * @var \WHO\WhoShop\Utility\MailHandler
	 * @inject
	 */
	protected $mailHandler = NULL;


	/**
	 * basketList action
	 */
	public function basketListAction() {
		DebuggerUtility::var_dump($this->basketHandler->getOrder());
		$this->view->assignMultiple(
			array(
				'products' => $this->productRepository->findByUidList(array_keys($this->basketHandler->getOrder())),
				'basket' => $this->basketHandler->getOrder(),
				'userIsLoggedIn' => $this->basketHandler->loginCheck(),
			)
		);
	}

	public function bindingOrderAction(){
		DebuggerUtility::var_dump($GLOBALS['TSFE']->fe_user->user);
	}

	public function orderCompleteAction(){

		// 1.: saveOrder
		$savedOrder = $this->saveOrder();
		DebuggerUtility::var_dump($savedOrder, 'saved Order');

		//send mail to customer

		$this->mailHandler->sendMailToCustomer('my-private@mail.com','noreply@dumfart-shop.at', 'Ihre Bestellung', 'Vielen Danke, Ihre Bestellung ist bei uns eingegangen.');

		$this->clearBasket();

	}

	/**
	 * @return \WHO\WhoShop\Domain\Model\Order
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 */
	private function saveOrder(){
		$newOrder = new \WHO\WhoShop\Domain\Model\Order();
		$newOrder->setUser($this->frontendUserRepository->findById($GLOBALS['TSFE']->fe_user->user['uid']));
		$newOrder->setOrderDate(time());
		$newOrder->setState(1);
		$this->orderRepository->add($newOrder);
		$this->persistenceManager->persistAll();

		foreach($this->basketHandler->getOrder() as $productUid => $orderParams){

			if($productUid == 'count'){
				continue;
			}

			$newOrderItem = new \WHO\WhoShop\Domain\Model\OrderItem();
			$newOrderItem->setOrderSize($orderParams['orderSize']);
			$newOrderItem->setorderValue($orderParams['orderValue']);
			DebuggerUtility::var_dump($productUid);
			$newOrderItem->addProduct($this->productRepository->findById($productUid)->getFirst());
			$this->orderItemRepository->add($newOrderItem);
			$this->persistenceManager->persistAll();

			$newOrder->addOrderItem($newOrderItem);
			$this->orderRepository->update($newOrder);

			$this->persistenceManager->persistAll();
		}

		return $newOrder;
	}


	/**
	 * @return void
	 */
	private function clearBasket(){
		$this->basketHandler->updateOrder(array());
	}
}