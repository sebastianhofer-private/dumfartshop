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
 * Class ForVoewHelper
 * @package WHO\WhoShop\ViewHelpers
 */
class EntryViewHelper extends AbstractViewHelper {

	/**
	 * @param int $uid
	 * @param array $basketArray
	 * @return mixed
	 */
	public function render($uid=0, array $basketArray=array()){
		if($this->templateVariableContainer->exists('pieces')){
			$this->templateVariableContainer->remove('pieces');
		}
		if($this->templateVariableContainer->exists('money')) {
			$this->templateVariableContainer->remove('money');
		}
		$this->templateVariableContainer->add('pieces', $basketArray[$uid]['orderSize']);
		$this->templateVariableContainer->add('money', $basketArray[$uid]['orderValue']);

		$content = $this->renderChildren();
		return $content;
	}
}