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
	 * sessionHandler
	 *
	 * @var \WHO\WhoShop\Utility\BasketHandler
	 * @inject
	 */
	protected $basketHandler = NULL;

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

		$category = $this->categoryRepository->findByUid($_GET['tx_whoshop_category']['category']);

		if($category == NULL){
			$category = $this->categoryRepository->findByUid($this->settings['defaultCategory']);
		}

		$products = $this->productRepository->findByCat($category);

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

		$this->assignArray = array(
			'product' => $product,
			'articleInBasket' => $this->basketHandler->findItemInOrder($product->getUid())['productFound'],
			'category' => $this->request->getArgument('category')
			//'userIsLoggedIn' => $this->shopSessionHandler->testUser()
		);
		$this->view->assignMultiple($this->assignArray);
	}

	/**
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 */
	public function addToBasketAction(\WHO\WhoShop\Domain\Model\Product $product) {
		if(!$this->basketHandler->addItemToOrder($product->getUid(),$this->request->getArgument('orderSize'),$product->getPrice())){
			//There should be done something. An error or soomething else...
		}

		$this->forward('show','Product','whoshop', $this->request->getArguments());
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

	public function ajaxAction(){
		$arguments = $this->request->getArguments();

		$this->view->assign("test", "some content");
		$this->view->assign("someOtherParamsForAction", $arguments['someOtherParamsForAction']);

		$content = $this->view->render();

		return json_encode(array(
			'success' => true,
			'content' => $content
		));
	}
}