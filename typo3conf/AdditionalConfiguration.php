<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
 * Development environment
 * TYPO3_CONTEXT Development
 */
if(\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment()) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = '[DEV] Dumfart Shop';

	$GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = 'typo3-cms';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = '127.0.0.1';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = 'password';
	$GLOBALS['TYPO3_CONF_VARS']['DB']['port'] = 3306;
	$GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = 'typo3-cms';

	$GLOBALS['TYPO3_CONF_VARS']['BE']['installToolPassword'] = '$P$CfuZn29gFw3yItFvSzdoCswAhQ5qzL0';
}