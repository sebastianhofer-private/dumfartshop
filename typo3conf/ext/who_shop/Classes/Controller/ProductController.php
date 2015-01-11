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
	 * sessionHandler
	 *
	 * @var \WHO\WhoShop\Utility\ShopSessionHandler
	 * @inject
	 */
	protected $shopSessionHandler = NULL;

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

		$this->shopSessionHandler->setPrefixKey('tx_whoshop_');

		DebuggerUtility::var_dump($product);

		$this->assignArray = array(
			'product' => $product,
			'userIsLoggedIn' => $this->shopSessionHandler->testUser()
		);
DebuggerUtility::var_dump($GLOBALS['TSFE']->fe_user);
		DebuggerUtility::var_dump($this->shopSessionHandler->restoreFromSession('product_' . $product->getUid()));
		die();

		$this->view->assignMultiple($this->assignArray);
	}

	/**
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 */
	public function addToBasketAction(\WHO\WhoShop\Domain\Model\Product $product) {

		if(!$this->shopSessionHandler->testUser()){
			$this->success = FALSE;
		}else{
			$this->shopSessionHandler->writeToSession($product, 'product_' . $product->getUid());
			$this->success = TRUE;
		}

		$this->request->setArgument('successfullyAddedToBasket', $this->success);
		$this->request->setArgument('forwardedFromAction', 'addToBasket');

		$this->forward('show','Product','whoshop', $this->request->getArguments());
	}
}