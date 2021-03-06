<?php

$domain = 'shop.dumfart-trio.at';

if(\TYPO3\CMS\Core\Utility\GeneralUtility::getApplicationContext()->isDevelopment()){
	$domain = 'shop.dumfart.dev';
}

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']=array (
	$domain =>
		array (
			'init' =>
				array (
					'enableCHashCache' => true,
					'appendMissingSlash' => 'ifNotFile,redirect',
					'adminJumpToBackend' => true,
					'enableUrlDecodeCache' => true,
					'enableUrlEncodeCache' => true,
					'emptyUrlReturnValue' => '/',
				),
			'pagePath' =>
				array (
					'type' => 'user',
					'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
					'spaceCharacter' => '-',
					'languageGetVar' => 'L',
					'rootpage_id' => '1',
				),
			'fileName' =>
				array (
					'defaultToHTMLsuffixOnPrev' => 0,
					'acceptHTMLsuffix' => 1,
					'index' =>
						array (
							'print' =>
								array (
									'keyValues' =>
										array (
											'type' => 98,
										),
								),
						),
				),
		),
);