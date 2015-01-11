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
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class BasketHandler
 * @package WHO\WhoShop\Utility
 */
class BasketHandler implements SingletonInterface {

	/**
	 * sessionHandler
	 *
	 * @var \WHO\WhoShop\Utility\ShopSessionHandler
	 * @inject
	 */
	protected $shopSessionHandler = NULL;

}