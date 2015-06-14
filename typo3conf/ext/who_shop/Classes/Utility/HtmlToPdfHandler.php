<?php
namespace WHO\WhoShop\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

//require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

//die(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('who_shop') . 'Resources/Private/Php/html2pdf/html2pdf.class.php');




class HtmlToPdfHandler {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * @var string
	 */
	protected $template = '';

	/**
	 * @var array
	 */
	protected $varables = array();

	/**
	 * @var string
	 */
	protected $filePath = '';

	/**
	 * @var null
	 */
	protected $html2pdf = NULL;

	/**
	 * @param string $template
	 */
	public function __construct($template = 'Bill/Bill.html'){
		$this->template = $template;
		$this->injectObjectManager();
	}

	public function createPdfFromTemplate($pdfFileName){

		$html = $this->parseFluidtemplate();
		$this->createPdf($html, 'A4', 'de', $pdfFileName);

	}

	/**
	 * Creates a fluid instance with given template-file and controller-settings
	 * @param string $file Path below Template-Root-Path (Resources/Private/Templates/$file)
	 * @return \TYPO3\CMS\Fluid\View\StandaloneView Fluid-Template-Renderer
	 */
	protected function getFluidRenderer($file = 'Email/Email.txt') {
		// create another instance of Fluid
		$renderer = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		#$renderer->setFormat("html");
		// find the view-settings and set the template-files
		//$conf = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$renderer->setTemplatePathAndFilename(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:who_shop/Resources/Private/Templates/') . $file);
		$renderer->setLayoutRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:who_shop/Resources/Private/Layouts/'));
		$renderer->setPartialRootPath(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:who_shop/Resources/Private/Partials/'));

		// and return the new Fluid instance
		return $renderer;
	}

	private function createPdf($htmlContent, $paperFormat, $language, $fileName){

		$this->html2pdf = GeneralUtility::makeInstance('HTML2PDF','P','A4','de', true, 'UTF-8', array(25,16.9,10,16));
		$this->html2pdf->WriteHTML($htmlContent);
		$this->html2pdf->Output($this->filePath . $fileName,"F");
	}

	/**
	 * @return void
	 */
	private function injectObjectManager() {
		$this->objectManager = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Object\ObjectManager');
	}

	/**
	 * @return string
	 */
	private function parseFluidtemplate(){
		$renderer = $this->getFluidRenderer($this->template);
		$renderer->assignMultiple($this->varables);
		return $renderer->render();
	}

	/**
	 * @return string
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 * @param string $template
	 */
	public function setTemplate( $template ) {
		$this->template = $template;
	}

	/**
	 * @return array
	 */
	public function getVarables() {
		return $this->varables;
	}

	/**
	 * @param array $varables
	 */
	public function setVarables( $varables ) {
		$this->varables = $varables;
	}

	/**
	 * @return string
	 */
	public function getFilePath() {
		return $this->filePath;
	}

	/**
	 * @param string $filePath
	 */
	public function setFilePath( $filePath ) {
		$this->filePath = $filePath;
	}



}