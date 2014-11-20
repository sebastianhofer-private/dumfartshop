<?php
return array(
	'BE' => array(
		'debug' => TRUE,
		'explicitADmode' => 'explicitAllow',
		'installToolPassword' => '$P$CAxYogixa/O0PL7v1dl6CqFPSZWoy/.',
		'loginSecurityLevel' => 'rsa',
		'compressionLevel' => '9',
	),
	'DB' => array(
		'database' => 'typo3-cms',
		'extTablesDefinitionScript' => 'extTables.php',
		'host' => '127.0.0.1',
		'password' => 'password',
		'port' => 3306,
		'socket' => '',
		'username' => 'typo3-cms',
	),
	'EXT' => array(
		'extConf' => array(
			'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
			'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
		),
	),
	'FE' => array(
		'activateContentAdapter' => FALSE,
		'debug' => TRUE,
		'loginSecurityLevel' => 'rsa',
		'compressionLevel' => '9',
	),
	'GFX' => array(
		'colorspace' => 'RGB',
		'im' => 1,
		'im_mask_temp_ext_gif' => 1,
		'im_path' => '/usr/bin/',
		'im_path_lzw' => '/usr/bin/',
		'im_v5effects' => -1,
		'im_version_5' => 'gm',
		'image_processing' => 1,
		'jpg_quality' => '80',
	),
	'SYS' => array(
		'caching' => array(
			'cacheConfigurations' => array(
				'extbase_object' => array(
					'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
					'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
					'groups' => array(
						'system',
					),
					'options' => array(
						'defaultLifetime' => 0,
					),
				),
			),
		),
		'clearCacheSystem' => TRUE,
		'compat_version' => '6.2',
		'devIPmask' => '*',
		'displayErrors' => 1,
		'enableDeprecationLog' => 'file',
		'encryptionKey' => 'd1d1ec27950cd23e371218c99e2f4b71e2b372be07c73d85eec7f9f1e3793ff83aec7ed3a6578fd005c0489ad69fee94',
		'exceptionalErrors' => 28674,
		'isInitialInstallationInProgress' => FALSE,
		'sitename' => 'Dumfart Shop',
		'sqlDebug' => 1,
		'systemLogLevel' => 0,
		't3lib_cs_convMethod' => 'mbstring',
		't3lib_cs_utils' => 'mbstring',
	),
);
?>