<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WHO.' . $_EXTKEY,
	'Product',
	array(
		'Product' => 'list, show, addToBasket, removeFromBasket, ajax',
	),
	// non-cacheable actions
	array(
		'Product' => 'addToBasket, removeFromBasket, ajax',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WHO.' . $_EXTKEY,
	'Category',
	array(
		'Category' => 'menu, switch',
	),
	// non-cacheable actions
	array(
		'Category' => '',

	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WHO.' . $_EXTKEY,
	'OrderItem',
	array(
		'OrderItem' => 'basketList, bindingOrder, orderComplete',
	),
	// non-cacheable actions
	array(
		'OrderItem' => 'basketList, bindingOrder',

	)
);

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['ajaxTest'] = 'EXT:whoshop/Classes/Utility/AjaxTest.php';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['WHO\WhoShop\Task\WorkOrders'] = array(
	'extension' => $_EXTKEY,
	'title' => 'work through orders',
	'description' => 'works through orders and send mails',
);
