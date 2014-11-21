<?php

namespace WhoShop\WhoShop\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \WhoShop\WhoShop\Domain\Model\Product.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Hofer <sebastian.hofer@s-hofer.de>
 */
class ProductTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WhoShop\WhoShop\Domain\Model\Product
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WhoShop\WhoShop\Domain\Model\Product();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriceReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getPrice()
		);
	}

	/**
	 * @test
	 */
	public function setPriceForIntegerSetsPrice() {
		$this->subject->setPrice(12);

		$this->assertAttributeEquals(
			12,
			'price',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getcategoriesReturnsInitialValueFor() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getcategories()
		);
	}

	/**
	 * @test
	 */
	public function setcategoriesForObjectStorageContainingSetscategories() {
		$categories = new ();
		$objectStorageHoldingExactlyOnecategories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnecategories->attach($categories);
		$this->subject->setcategories($objectStorageHoldingExactlyOnecategories);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnecategories,
			'categories',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addcategoriesToObjectStorageHoldingcategories() {
		$categories = new ();
		$categoriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$categoriesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($categories));
		$this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

		$this->subject->addcategories($categories);
	}

	/**
	 * @test
	 */
	public function removecategoriesFromObjectStorageHoldingcategories() {
		$categories = new ();
		$categoriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$categoriesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($categories));
		$this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

		$this->subject->removecategories($categories);

	}
}
