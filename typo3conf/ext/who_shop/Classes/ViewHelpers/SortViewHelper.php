<?php
namespace WHO\WhoShop\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 */

use TYPO3\CMS\Extbase\Persistence\Generic\LazyObjectStorage;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class SortViewHelper
 * @package WHO\WhoShop\ViewHelpers
 */
class SortViewHelper extends AbstractViewHelper {


	/**
	 * @var string
	 */
	protected $sortBy = '';

	/**
	 * @var array
	 */
	protected $sortArray = array();

	/**
	 * @var string
	 */
	protected $returnList = '';

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
		$this->registerArgument('sortBy', 'string', 'Which property/field to sort by - leave out for numeric sorting based on indexes(keys)', TRUE, 'sorting');
		$this->registerArgument('order', 'string', 'ASC or DESC', FALSE, 'ASC');
	}

	/**
	 * "Render" method - sorts a target list-type target. Either $array or $objectStorage must be specified. If both are,
	 * ObjectStorage takes precedence.
	 *
	 * @param array|object An array, Iterator, ObjectStorage, LazyObjectStorage or QueryResult to sort
	 * @return mixed
	 */
	public function render($subject=NULL) {
		$this->sortObjectStorage($subject);
		return $this->sortArray;
	}

	/**
	 * @param ObjectStorage $objStorage
	 * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
	 */
	protected function sortObjectStorage(ObjectStorage $objStorage = NULL) {

		if($objStorage == NULL) {
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('No ObjectStorage object given.', 1253857401);
		}

		foreach($objStorage as $object){
			$this->sortArray[$object->_getProperty($this->arguments['sortBy'])] = $object;
		}

		if($this->arguments['order'] === 'ASC'){
			ksort($this->sortArray);
		}elseif($this->arguments['order'] === 'DESC'){
			krsort($this->sortArray);
		}
	}
}