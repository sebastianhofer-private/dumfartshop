<?php
namespace WHO\WhoShop\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 ***************************************************************/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * CategoryController
 */
class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * categoryRepository
	 *
	 * @var \WHO\WhoShop\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * @var null
	 */
	protected $categories = NULL;

	/**
	 * @var array
	 */
	protected $getArguments = array();

	/**
	 * @var bool
	 */
	protected $isProductDetailView = 0;

	/**
	 * action menu
	 *
	 * @param \WHO\WhoShop\Domain\Model\Category $category
	 * @return void
	 */
	public function menuAction(\WHO\WhoShop\Domain\Model\Category $category = NULL) {

		$this->getArguments = $_GET;

		if($category == NULL && isset($this->getArguments['tx_whoshop_product']['category']) && $this->getArguments['tx_whoshop_product']['category'] != NULL){
			$category = $this->categoryRepository->findByUid($this->getArguments['tx_whoshop_product']['category']);
			$this->isProductDetailView = 1;
		}

		if($this->settings['isContentCatNav'] && $category != NULL){
			$this->settings['rootParent'] = $category->getUid();
		}elseif($this->settings['isNavSecondary'] && $category != NULL){
			$this->settings['rootParent'] = $category->getParent()->getUid();
		}

		if($category == NULL){
			$givenCat = NULL;
			$catGiven = 0;
		}else{
			$catGiven = 1;
			$givenCat = $category->getUid();
		}

		$firstLevelCategories = $this->categoryRepository->findAllFirstLevelByPid($this->settings['storagePid'],$this->settings['rootParent']);

		$this->addChildren($firstLevelCategories,$this->settings['maxMenuDepth'],0);

		$this->categories = $firstLevelCategories;

		$unsortedCategories = $this->categoryRepository->findAll();

		$assignArray = array(
			'isProductDetailView' => $this->isProductDetailView,
			'catGiven' => $catGiven,
			'givenCat' => $givenCat,
			'categories' => $this->categories,
			'unsortedCategories' => $unsortedCategories,
		);

		//DebuggerUtility::var_dump($assignArray);

		$this->view->assignMultiple($assignArray);
	}

	/**
	 * action tree
	 *
	 * @return void
	 */
	public function treeAction() {
		
	}

	public function switchAction(\WHO\WhoShop\Domain\Model\Category $category) {

	}

	private function addChildren(&$parentCats, $maxDepth = 3, $depthCount = 0) {

		$depthCount++;
		foreach($parentCats as $parentCat) {
			$parentCat->setDepth($depthCount);
			if($depthCount < $maxDepth){
				$parentCat->setChildren($this->categoryRepository->findAllByParent($parentCat->getUid()));
				$this->addChildren($parentCat->getChildren(),$maxDepth,$depthCount);
			}
		}
	}
}