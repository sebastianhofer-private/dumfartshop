<?php

$extPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('who_shop');
$libPath = 'Resources/Private/Php/Libraries/';

return array(
	'HTML2PDF' => $extPath . $libPath . 'html2pdf/html2pdf.php',
);