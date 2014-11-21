<?php
namespace WHO\WhoCatMenu\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
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
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category {


	/**
	 * @var int
	 */
	protected $depth = 0;

	/**
	 * @var array
	 */
	protected $children = array();

	/**
	 * @var bool
	 */
	protected $hasChildren = FALSE;

	/**
	 * @var \WHO\WhoCatMenu\Domain\Model\Category|NULL
	 * @lazy
	 */
	protected $parent = NULL;

	/**
	 * Gets the parent category.
	 *
	 * @return \WHO\WhoCatMenu\Domain\Model\Category|NULL the parent category
	 * @api
	 */
	public function getParent()
	{
		if ($this->parent instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
			$this->parent->_loadRealInstance();
		}
		return $this->parent;
	}

	/**
	 * Sets the parent category.
	 *
	 * @param \WHO\WhoCatMenu\Domain\Model\Category $parent the parent category
	 * @return void
	 * @api
	 */
	public function setParent(\WHO\WhoCatMenu\Domain\Model\Category $parent)
	{
		$this->parent = $parent;
	}

	/**
	 * @return boolean
	 */
	public function isHasChildren()
	{
		return $this->hasChildren;
	}

	/**
	 * @param boolean $hasChildren
	 */
	public function setHasChildren($hasChildren)
	{
		$this->hasChildren = $hasChildren;
	}

	/**
	 * @return array
	 */
	public function getChildren()
	{
		return $this->children;
	}

	/**
	 * @param array $children
	 */
	public function setChildren($children)
	{
		$this->children = $children;
	}

	/**
	 * @return int
	 */
	public function getDepth()
	{
		return $this->depth;
	}

	/**
	 * @param int $depth
	 */
	public function setDepth($depth)
	{
		$this->depth = $depth;
	}




}