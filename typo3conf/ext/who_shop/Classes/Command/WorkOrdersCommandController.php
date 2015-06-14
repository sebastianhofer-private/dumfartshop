<?php

namespace WHO\WhoShop\Command;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class WorkOrdersCommandController extends CommandController {


	/**
	 * orderItemRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\OrderRepository
	 * @inject
	 */
	protected $orderRepository = NULL;

	/**
	 * @var null
	 */
	protected $objectManager = NULL;

	/**
	 * @return bool
	 */
	public function execute(){
		$success = TRUE;

		//$this->objectManager = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Object\ObjectManager');
		//$this->orderRepository = $this->objectManager->get('\WHO\WhoShop\Domain\Repository\OrderRepository');
			//GeneralUtility::makeInstance('WHO\\WhoShop\\Domain\\Repository\\OrderRepository');

		$count = $this->orderRepository->testFunc();
		DebuggerUtility::var_dump($count);
		debug(ArrayUtility::convertObjectToArray($this));
		return $success;
	}

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
}