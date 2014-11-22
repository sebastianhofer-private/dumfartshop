<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_whoshop_domain_model_product'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_whoshop_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, title, description, price, categories',
	),
	'types' => array(
		'0' => array('showitem' => ';;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, type, title, price, additional_information, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.div.image, image, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.div.categories, categories, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.div.tracks, tracks, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
		'1' => array('showitem' => ';;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, type, title, sub_title, publishing_number, additional_information, price, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.div.image, image, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.div.categories, categories, --div--;LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.div.tracks, tracks, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_whoshop_domain_model_product',
				'foreign_table_where' => 'AND tx_whoshop_domain_model_product.pid=###CURRENT_PID### AND tx_whoshop_domain_model_product.sys_language_uid IN (-1,0)',
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
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('Tonträger', 0),
					array('Noten', 1),
				),
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'required, trim'
			),
		),
		'sub_title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.sub_title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'additional_information' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.additional_information',
			'config' => array(
                'type' => 'text',
                'cols' => '40',
                'rows' => '8'
        	)
		),
		'publishing_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.publishing_number',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim'
			)
		),
		'price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.price',
			'config' => array(
				'type' => 'input',
				'size' => 3,
				'eval' => 'trim,double2'
			)
		),
		'categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_category',
				'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.sorting ASC',
				'MM' => 'sys_category_record_mm',
				'MM_match_fields' => array(
					'fieldname' => 'categories',
					'tablenames' => 'tx_whoshop_domain_model_product'
				),
				'MM_opposite_field' => 'items',
				'size' => 10,
				'autoSizeMax' => 20,
				'minitems' => 0,
				'maxitems' => 20,
				'renderMode' => 'tree',
				'treeConfig' => array(
					'expandAll' => true,
					'parentField' => 'parent',
					'appearance' => array(
						'showHeader' => true,
						'allowRecursiveMode' => TRUE,
						'expandAll' => TRUE,
						'maxLevels' => 99,
					),
				),
			),
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image',
				array(
					'appearance' => array(
						'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
					),
					// custom configuration for displaying fields in the overlay/reference table
					// to use the imageoverlayPalette instead of the basicoverlayPalette
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						),
					),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
				)
			)
		),
		'tracks' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:who_shop/Resources/Private/Language/locallang_db.xlf:tx_whoshop_domain_model_product.tracks',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_whoshop_domain_model_track',
				'foreign_field' => 'content_element',
				'maxitems'		=> 1000,
				'appearance' => array(
					'collapseAll' => TRUE,
					'ajaxLoad' => TRUE,
					'levelLinksPosition' => 'both',
					'showSynchronizationLink' => TRUE,
					'showPossibleLocalizationRecords' => TRUE,
					'showAllLocalizationLink' => TRUE,
				),
			),
		),
	),
);
