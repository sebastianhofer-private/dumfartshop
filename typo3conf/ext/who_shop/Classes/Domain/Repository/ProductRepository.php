<?php
namespace WHO\WhoShop\Domain\Repository;

class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @param \WHO\WhoShop\Domain\Model\Category $cat
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByCat(\WHO\WhoShop\Domain\Model\Category $cat) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);

		$query->matching(
				$query->contains('categories', $cat)
		);

		return $query->execute();
	}
}