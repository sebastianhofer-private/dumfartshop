<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_whoshop_domain_model_track'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_whoshop_domain_model_track']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, track_number, title, authority, has_example, example',
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, authority, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_track.div.audio, has_example, example, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_whoshop_domain_model_track',
				'foreign_table_where' => 'AND tx_whoshop_domain_model_track.pid=###CURRENT_PID### AND tx_whoshop_domain_model_track.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'track_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_track.track_number',
			'config' => array(
				'type' => 'input',
				'size' => 1,
				'eval' => 'trim'
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_track.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required,trim'
			),
		),
		'authority' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_track.authority',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'has_example' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_track.has_example',
			'config' => array(
				'type' => 'check',
				'default' => '0',
				'eval' => 'num',
			),
		),
		'example' => array(
			'exclude' => 0,
			'displayCond' => 'FIELD:has_example:=:1',
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_track.example',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('media'),
		),
		'content_element' => array(
			'config' => array(
				'type' => 'passthrough'
			),
		),
		'sorting' => array(
			'config' => array(
				'type' => 'passthrough'
			),
		),
	),
);
