<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WHO.' . $_EXTKEY,
	'Product',
	array(
		'Product' => 'list, show',
	),
	// non-cacheable actions
	array(
		'Product' => '',
		
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

