<?php
namespace WHO\WhoCatMenu\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * CategoryController
 */
class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * categoryRepository
	 *
	 * @var \WHO\WhoCatMenu\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * @var null
	 */
	protected $categories = NULL;

	/**
	 * action menu
	 *
	 * @return void
	 */
	public function menuAction() {
		$firstLevelCategories = $this->categoryRepository->findAllFirstLevelByPid($this->settings['storagePid'],$this->settings['rootParent']);

		$this->addChildren($firstLevelCategories,$this->settings['maxMenuDepth'],0);

		$this->categories = $firstLevelCategories;

		$this->view->assign('categories', $this->categories);
	}

	/**
	 * action tree
	 *
	 * @return void
	 */
	public function treeAction() {
		
	}

	private function addChildren(&$parentCats,$maxDepth = 3, $depthCount = 0) {
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