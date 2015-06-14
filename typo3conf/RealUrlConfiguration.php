<?php
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']=unserialize('a:1:{s:20:"shop.dumfart-trio.at";a:3:{s:4:"init";a:6:{s:16:"enableCHashCache";b:1;s:18:"appendMissingSlash";s:18:"ifNotFile,redirect";s:18:"adminJumpToBackend";b:1;s:20:"enableUrlDecodeCache";b:1;s:20:"enableUrlEncodeCache";b:1;s:19:"emptyUrlReturnValue";s:1:"/";}s:8:"pagePath";a:5:{s:4:"type";s:4:"user";s:8:"userFunc";s:68:"EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main";s:14:"spaceCharacter";s:1:"-";s:14:"languageGetVar";s:1:"L";s:11:"rootpage_id";s:1:"1";}s:8:"fileName";a:3:{s:25:"defaultToHTMLsuffixOnPrev";i:0;s:16:"acceptHTMLsuffix";i:1;s:5:"index";a:1:{s:5:"print";a:1:{s:9:"keyValues";a:1:{s:4:"type";i:98;}}}}}}');

if(\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment()){
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['shop.dumfart.dev'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['shop.dumfart-trio.at'];
}