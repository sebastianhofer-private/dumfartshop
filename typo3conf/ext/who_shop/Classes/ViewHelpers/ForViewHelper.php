<?php
namespace WHO\WhoShop\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class ForViewhelper extends AbstractViewHelper {

	/**
	 * @param array $givenArray
	 * @return string
	 */
	public function render(array $givenArray = array()){
		$content = '';
		foreach($givenArray as $key => $value){
			$content .= '<p>';
			$content .= '<span>' . $key . ' => ' . $value;
			$content .= '</p>';
		}

		return $content;
	}
}