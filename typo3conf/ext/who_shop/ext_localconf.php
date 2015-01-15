<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WHO.' . $_EXTKEY,
	'Product',
	array(
		'Product' => 'list, show, addToBasket, removeFromBasket',
	),
	// non-cacheable actions
	array(
		'Product' => 'addToBasket, removeFromBasket',
		
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
		'OrderItem' => 'basketList',
	),
	// non-cacheable actions
	array(
		'OrderItem' => 'basketList',

	)
);
