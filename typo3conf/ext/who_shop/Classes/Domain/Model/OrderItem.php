<?php
namespace WHO\WhoShop\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 ***************************************************************/

/**
 * Class OrderItem
 * @package WHO\WhoShop\Domain\Model
 */
class OrderItem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var int
	 */
	protected $orderSize = 0;

	/**
	 * article
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<WHO\WhoShop\Domain\Model\Product>
	 * @lazy
	 */
	protected $article = NULL;

	/**
	 * @var int
	 */
	protected $orderValue = 0;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->article = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @param $article
	 */
	public function addArticle($article) {
		$this->article->attach($article);
	}

	/**
	 * @param $articleToRemove
	 */
	public function removeArticle($articleToRemove) {
		$this->article->detach($articleToRemove);
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getArticle()
	{
		return $this->article;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $article
	 */
	public function setArticle($article)
	{
		$this->article = $article;
	}

	/**
	 * @return int
	 */
	public function getOrderSize()
	{
		return $this->orderSize;
	}

	/**
	 * @param int $orderSize
	 */
	public function setOrderSize($orderSize)
	{
		$this->orderSize = $orderSize;
	}

	/**
	 * @return int
	 */
	public function getorderValue()
	{
		return $this->orderValue;
	}

	/**
	 * @param int $orderValue
	 */
	public function setorderValue($orderValue)
	{
		$this->orderValue = $orderValue;
	}


}