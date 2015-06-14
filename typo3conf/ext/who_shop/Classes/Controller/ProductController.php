<?php
namespace WHO\WhoShop\Controller;


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
use WHO\WhoShop\Domain\Model\Product;

/**
 * ProductController
 */
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * productRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository = NULL;

	/**
	 * categoryRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * orderRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\OrderRepository
	 * @inject
	 */
	protected $orderRepository = NULL;

	/**
	 * orderItemRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\OrderItemRepository
	 * @inject
	 */
	protected $orderItemRepository = NULL;

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
	 * sessionHandler
	 *
	 * @var \WHO\WhoShop\Utility\ShopSessionHandler
	 * @inject
	 */
	protected $sessionHandler = NULL;

	/**
	 * @var array
	 */
	protected $assignArray = array();

	/**
	 * @var bool
	 */
	protected $success = FALSE;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {

		$childList = array();
		$category = $this->categoryRepository->findByUid($_GET['tx_whoshop_category']['category']);

		DebuggerUtility::var_dump($category);

		$this->getCatUidListRecursive($category, $childList);

		DebuggerUtility::var_dump($childList, 'childList');
		if($category == NULL){
			$category = $this->categoryRepository->findByUid($this->settings['defaultCategory']);
		}

		$products = $this->productRepository->findByCat($category);
		$productsArray = $products->toArray();

		if(empty($productsArray) && !empty($childList)){
			DebuggerUtility::var_dump('products empty');

			$products = $this->productRepository->findByCatList($childList);
		}

		DebuggerUtility::var_dump($products, 'Produkte');

		$this->view->assign('products', $products);
		$this->view->assign('category', $category);
	}

	/**
	 * action show
	 *
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @return void
	 */
	public function showAction(\WHO\WhoShop\Domain\Model\Product $product) {
		DebuggerUtility::var_dump($this->basketHandler->getOrder());
		$this->assignArray = array(
			'product' => $product,
			'articleInBasket' => $this->basketHandler->findItemInOrder($product->getUid())['productFound'],
			'category' => $this->request->getArgument('category'),
			'userIsLoggedIn' => $this->basketHandler->loginCheck()
		);
		$this->view->assignMultiple($this->assignArray);
	}

	/**
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @return string
	 */
	public function addToBasketAction(\WHO\WhoShop\Domain\Model\Product $product) {
		$success = true;
		$arguments = $this->request->getArguments();
		if(!$this->basketHandler->addItemToOrder($product->getUid(),$this->request->getArgument('orderSize'),$product->getPrice())){
			$success = false;
		}



		//$this->forward('show','Product','whoshop', $this->request->getArguments());
		return json_encode(array(
			'success' => $success,
			'arguments' => $arguments,
		));
	}

	/**
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 */
	public function removeFromBasketAction(\WHO\WhoShop\Domain\Model\Product $product) {
		if(!$this->basketHandler->removeItemFromOrder($product->getUid())){
			//There should be done something. An error or soomething else...
		}
		$this->forward('show','Product','whoshop', $this->request->getArguments());
	}

	/**
	 * @return string
	 */
	public function ajaxAction(){
		$success = FALSE;
		$basketCount = 0;
		$product = $this->request->getArgument('product');
		$orderSize = $this->request->getArgument('ordersize');
		$forwarAction = $this->request->getArgument('forwardAction');

		if($product != 0){
			switch($forwarAction) {
				case 'addToBasket': $success = $this->addToBasket($this->productRepository->findByUid($product), $orderSize);
					break;
				case 'removeFromBasket': $success = $this->removeFromBasket($this->productRepository->findByUid($product));
					break;
				case 'updateOrderSize': $success = $this->updateOrderSize($product, $orderSize);
					break;
			}

			$basketCount = $this->basketHandler->getOrder();
		}

		return json_encode(
			array(
				'success' => $success,
				'basketcount' => '4',
		));
	}

	/**
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @return string
	 */
	public function addToBasket(\WHO\WhoShop\Domain\Model\Product $product, $orderSize = 0) {
		$returnValue = FALSE;
		if($this->basketHandler->addItemToOrder($product->getUid(),$orderSize ,$product->getPrice())){
			//There should be done something. An error or soomething else...
			$returnValue = TRUE;
		}

		//$this->forward('show','Product','whoshop', $this->request->getArguments());
		return $returnValue;
	}

	public function removeFromBasket(\WHO\WhoShop\Domain\Model\Product $product) {
		$returnValue = FALSE;
		if($this->basketHandler->removeItemFromOrder($product->getUid())){
			$returnValue = TRUE;
		}

		return $returnValue;
	}

	public function updateOrderSize($product, $orderSize = 0) {
		$returnValue = FALSE;
		if($this->basketHandler->updateItemOrderSize($product, $orderSize)){
			$returnValue = TRUE;
		}

		return $returnValue;
	}

	private function getCatUidListRecursive($category, &$childList) {
		foreach($category->getChildren() as $child) {
			$children = $child->getChildren();
			if(!empty($children)){
				$childList[] = $child->getUid();
				$this->getCatUidListRecursive($child, $childList);
			}else {
				$childList[] = $child->getUid();
			}
		}
	}
}