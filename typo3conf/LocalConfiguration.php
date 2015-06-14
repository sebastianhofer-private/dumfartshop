<?php
return array(
	'BE' => array(
		'compressionLevel' => '9',
		'debug' => TRUE,
		'explicitADmode' => 'explicitAllow',
		'installToolPassword' => '$P$CAmMUoHkTlwZkbiYqdLfGp19o/NcIW0',
		'loginSecurityLevel' => 'rsa',
		'versionNumberInFilename' => '0',
	),
	'DB' => array(
		'database' => 'db391808',
		'extTablesDefinitionScript' => 'extTables.php',
		'host' => 'mysql5.hofer.df-kunde.de',
		'password' => 'FDp3-mq6',
		'port' => 3306,
		'socket' => '',
		'username' => 'db391808',
	),
	'EXT' => array(
		'extConf' => array(
			'extension_builder' => 'a:3:{s:15:"enableRoundtrip";s:0:"";s:15:"backupExtension";s:1:"1";s:9:"backupDir";s:35:"uploads/tx_extensionbuilder/backups";}',
			'femanager' => 'a:2:{s:13:"disableModule";s:1:"0";s:10:"disableLog";s:1:"0";}',
			'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
			'saltedpasswords' => 'a:2:{s:3:"BE.";a:4:{s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}s:3:"FE.";a:5:{s:7:"enabled";i:1;s:21:"saltedPWHashingMethod";s:41:"TYPO3\\CMS\\Saltedpasswords\\Salt\\PhpassSalt";s:11:"forceSalted";i:0;s:15:"onlyAuthService";i:0;s:12:"updatePasswd";i:1;}}',
			'scheduler' => 'a:5:{s:11:"maxLifetime";s:4:"1440";s:11:"enableBELog";s:1:"1";s:15:"showSampleTasks";s:1:"1";s:11:"useAtdaemon";s:1:"0";s:30:"listShowTaskDescriptionAsHover";s:1:"1";}',
			'who_cat_menu' => 'a:0:{}',
			'who_shop' => 'a:0:{}',
		),
	),
	'EXTCONF' => array(
		'lang' => array(
			'availableLanguages' => array(
				'de',
			),
		),
	),
	'FE' => array(
		'activateContentAdapter' => FALSE,
		'compressionLevel' => '9',
		'debug' => FALSE,
		'loginSecurityLevel' => 'rsa',
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
		'curlUse' => '1',
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