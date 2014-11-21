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
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$products = $this->productRepository->findAll();
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