<?php
namespace WHO\WhoShop\Utility;

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
 * Class BasketSessionHandler
 * @package WHO\WhoShop\Utility
 */
class ShopSessionHandler implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * @var string
	 */
	protected $prefixKey = '';

	/**
	 * @var bool
	 */
	protected $userIsloggedIn = FALSE;

	/**
	 * @param string $prefixKey
	 */
	public function __construct($prefixKey = 'tx_whoshop_') {
		$this->setPrefixKey($prefixKey);
	}

	/**
	 * @return bool
	 */
	public function testUser() {
		$this->userIsloggedIn = FALSE;
		if($GLOBALS['TSFE']->loginUser){
			$this->userIsloggedIn = TRUE;
		}
		return $this->userIsloggedIn;
	}

	public function restoreFromSession($key) {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', $this->prefixKey . $key);
		return unserialize($sessionData);
	}

	/**
	 * @param $object
	 * @param $key
	 * @return $this
	 */
	public function writeToSession($object, $key) {
		$sessionData = serialize($object);
		$GLOBALS['TSFE']->fe_user->setKey('ses', $this->prefixKey . $key, $sessionData);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPrefixKey()
	{
		return $this->prefixKey;
	}

	/**
	 * @param string $prefixKey
	 */
	public function setPrefixKey($prefixKey)
	{
		$this->prefixKey = $prefixKey;
	}


}