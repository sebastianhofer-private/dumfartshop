<?php
namespace WHO\WhoShop\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class LinkViewhelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper{

	/**
	 * @var string
	 */
	protected $tagName = 'a';

	/**
	 * Arguments initialization
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
		$this->registerTagAttribute('data-toggle', 'string', 'data-toggle object', FALSE);
		//$this->registerTagAttribute('rel', 'string', 'Specifies the relationship between the current document and the linked document', FALSE);
	}

	/**
	 * @param string $uri
	 * @param int $category
	 * @return string
	 */
	public function render($uri = '') {

		/*
		$linkParams = array(
			'tx_whoshop[category]' => $category
		);*/

		$typolink = $GLOBALS['TSFE']->cObj->getTypoLink_URL($uri,$linkParams);

		if($uri == '#'){
			$typolink .= '#';
		}

		$this->tag->addAttribute('href', $typolink);
		$this->tag->setContent($this->renderChildren());

		return $this->tag->render();
	}
}