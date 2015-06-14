<?php
namespace In2\Femanager\Utility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Field Selection for FlexForm
 *
 * Class FlexFormFieldSelection
 */
class FlexFormFieldSelection {

	/**
	 * @var \TYPO3\CMS\Lang\LanguageService
	 */
	protected $languageService = NULL;

	/**
	 * Add options to FlexForm Selection - Options can be defined in TSConfig
	 *
	 * @param array $params
	 * @return void
	 */
	public function addOptions(&$params) {
		$this->initialize();
		$tSconfig = BackendUtility::getPagesTSconfig($this->getPid());
		$this->addCaptchaOption($params);
		if (!empty($tSconfig['tx_femanager.']['flexForm.'][$params['config']['itemsProcFuncTab'] . '.']['addFieldOptions.'])) {
			$options = $tSconfig['tx_femanager.']['flexForm.'][$params['config']['itemsProcFuncTab'] . '.']['addFieldOptions.'];
			foreach ((array) $options as $value => $label) {
				$params['items'][] = array(
					GeneralUtility::isFirstPartOfStr($label, 'LLL:') ? $this->languageService->sL($label) : $label,
					$value
				);
			}
		}
	}

	/**
	 * Add captcha option
	 *
	 * @param array $params
	 * @return void
	 */
	protected function addCaptchaOption(&$params) {
		if (ExtensionManagementUtility::isLoaded('sr_freecap')) {
			$params['items'][] = array(
				$this->languageService->sL(
					'LLL:EXT:femanager/Resources/Private/Language/locallang_db.xlf:tx_femanager_domain_model_user.captcha'
				),
				'captcha'
			);
		}
	}

	/**
	 * Read pid from current URL
	 * 		URL example:
	 * 		http://femanager.localhost.de/typo3/alt_doc.php?&returnUrl=
	 * 		%2Ftypo3%2Fsysext%2Fcms%2Flayout%2Fdb_layout.php
	 * 		%3Fid%3D17%23element-tt_content-14
	 * 		&edit[tt_content][14]=edit
	 *
	 * @return int
	 */
	protected function getPid() {
		$pid = 0;
		$backUrl = str_replace('?', '&', GeneralUtility::_GP('returnUrl'));
		$urlParts = GeneralUtility::trimExplode('&', $backUrl, 1);
		foreach ($urlParts as $part) {
			if (stristr($part, 'id=')) {
				$pid = str_replace('id=', '', $part);
			}
		}

		return intval($pid);
	}

	/**
	 * Initialize
	 *
	 * @return void
	 */
	protected function initialize() {
		$this->languageService = $GLOBALS['LANG'];
	}

}