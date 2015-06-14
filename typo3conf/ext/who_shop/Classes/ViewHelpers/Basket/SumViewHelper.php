<?php
namespace WHO\WhoShop\ViewHelpers\Basket;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 ***************************************************************/

/**
 * Class SumViewHelper
 * @package WHO\WhoShop\ViewHelpers\Basket
 */
class SumViewHelper extends AbstractViewHelper {

	/**
	 * @param array $basketArray
	 * @param int $addMailingExpenses
	 * @param int $mailingExpenses
	 * @return int
	 */
	public function render(array $basketArray = array(), $addMailingExpenses = 0, $mailingExpenses = 0) {
		$content = 0;
		foreach($basketArray as $basketItem){
			$content = $content + $basketItem['orderValue'];
		}
		if($addMailingExpenses){
			$content = $content + $mailingExpenses;
		}
		return $content;
	}
}