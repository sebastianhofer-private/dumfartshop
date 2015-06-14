<?php

namespace WHO\WhoShop\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class WorkOrders extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
	 * @var \WHO\WhoShop\Domain\Repository\OrderRepository
	 */
	protected $orderRepository = NULL;

	/**
	 * @var \WHO\WhoShop\Domain\Repository\UserRepository
	 */
	protected $userRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * @var \WHO\WhoShop\Utility\HtmlToPdfHandler
	 */
	protected $htmlToPdfHandler = NULL;


	/**
	 * @return bool
	 */
	public function execute(){
		$success = TRUE;

		$this->requiredInjects();

		$unworkedOrders = $this->orderRepository->findUnworkedOrders();

		foreach($unworkedOrders as $order){
			$orderingUser = $this->userRepository->findById($order->getUser());

			$this->createBill($order,$orderingUser);

			$this->setOrderToWorked($order);

			break;
		}

		return $success;
	}

	/**
	 * @return \TYPO3\CMS\Core\Messaging\FlashMessageQueue
	 */
	private function getDefaultFlashMessageQueue() {
		/** @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
		$flashMessageService = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
		/** @var $defaultFlashMessageQueue \TYPO3\CMS\Core\Messaging\FlashMessageQueue */
		return $flashMessageService->getMessageQueueByIdentifier();



		/*$flashMessageOk = GeneralUtility::makeInstance(
			'\\TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
			'Message to be passed',
			'OK Example',
			\TYPO3\CMS\Core\Messaging\FlashMessage::OK);
		$defaultFlashMEssageQueue = $this->getDefaultFlashMessageQueue();
		$defaultFlashMEssageQueue->enqueue($flashMessageOk);

		GeneralUtility::devLog('Message', 'who_whop',2,ArrayUtility::convertObjectToArray($this));*/
	}

	/**
	 * @return void
	 */
	private function injectObjectManager() {
		$this->objectManager = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Object\ObjectManager');
	}

	/**
	 *
	 */
	private function requiredInjects() {

		$this->injectObjectManager();

		// repositories
		$this->orderRepository = $this->objectManager->get('\WHO\WhoShop\Domain\Repository\OrderRepository');
		$this->userRepository = $this->objectManager->get('\WHO\WhoShop\Domain\Repository\UserRepository');

		// handlers
		$this->htmlToPdfHandler = $this->objectManager->get('\WHO\WhoShop\Utility\HtmlToPdfHandler');

	}

	private function createBill(\WHO\WhoShop\Domain\Model\Order $order, \WHO\WhoShop\Domain\Model\User $user){

		$billFileName = $order->getOrderDate() . '_' . $user->getName() . '.pdf';
		$billRelFilePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tx_whoshop/';

		$this->htmlToPdfHandler->setFilePath($billRelFilePath);
		$this->htmlToPdfHandler->setVarables($this->setVariablesForFluidtemplate($order,$user));

		$this->htmlToPdfHandler->createPdfFromTemplate($billFileName);
	}

	/**
	 * @param \WHO\WhoShop\Domain\Model\Order $order
	 * @param \WHO\WhoShop\Domain\Model\User $user
	 *
	 * @return array
	 */
	private function setVariablesForFluidtemplate(\WHO\WhoShop\Domain\Model\Order $order, \WHO\WhoShop\Domain\Model\User $user){

		$orderItems = $order->getOrderItem();

		$fluidItems = array();
		$orderSum = 0;

		foreach($orderItems as $item){
			$tempProd = NULL;

			foreach($item->getProduct() as $prod){
				$tempProd = $prod;
			}
			$fluidItems[] = array(
				'item' => $item,
				'itemProduct' => $tempProd,
				'itemPriceSum' => $tempProd->getPrice() * $item->getOrderSize(),
			);

			$orderSum = $orderSum + $tempProd->getPrice() * $item->getOrderSize();
		}

		$var = array(
			'user' => array(
				'firstname' => $user->getFirstName(),
				'lastname' => $user->getLastName(),
				'name' => $user->getName(),
				'address' => $user->getAddress(),
				'city' => $user->getCity(),
				'plz' => $user->getZip(),
				'email' => $user->getEmail()
			),
			'order' => array(
				'date' => $order->getOrderDate(),
				'orderSum' => $orderSum,
			),
			'orderItems' => $fluidItems,
		);
		return $var;
	}

	private function setOrderToWorked(\WHO\WhoShop\Domain\Model\Order $order) {
		$order->setState(2);
		$this->orderRepository->update($order);
		$this->objectManager->get('TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface')->persistAll();
	}
}