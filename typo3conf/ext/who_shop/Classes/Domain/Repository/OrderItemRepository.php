<?php
namespace WHO\WhoShop\Domain\Repository;

/**
 * Class OrderItemRepository
 * @package WHO\WhoShop\Domain\Repository
 */
class OrderItemRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @param int $id
	 * @return object
	 */
	public function findById($id = 0) {
		$query= $this->createQuery();

		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('uid',$id));

		$test = $query->execute()->getFirst();;
		return $test;
	}
}