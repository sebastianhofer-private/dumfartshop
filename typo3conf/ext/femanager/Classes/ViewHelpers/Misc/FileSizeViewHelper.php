<?php
namespace In2\Femanager\ViewHelpers\Misc;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Alex Kellner <alexander.kellner@in2code.de>, in2code
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Show filesize
 *
 * Class FileSizeViewHelper
 */
class FileSizeViewHelper extends AbstractViewHelper {

	/**
	 * A ViewHelper to get the Size of a File from a given $path
	 *
	 * @param string $path Filepath (like fileadmin/test.jpg)
	 * @param string $unit Unit (b, k, m)
	 * @return string The result
	 */
	public function render($path, $unit = 'k') {

		$filesize = array();
		$filesize['b'] = filesize($path);
		$filesize['k'] = round(($filesize['b'] / 1024), 0);
		$filesize['m'] = round(($filesize['k'] / 1024), 0);

		return $filesize[$unit];
	}
}