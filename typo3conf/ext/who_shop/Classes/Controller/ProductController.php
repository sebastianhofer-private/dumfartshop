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
	}

	/**
	 * action show
	 *
	 * @param \WHO\WhoShop\Domain\Model\Product $product
	 * @return void
	 */
	public function showAction(\WHO\WhoShop\Domain\Model\Product $product) {
		$this->view->assign('product', $product);
	}

}