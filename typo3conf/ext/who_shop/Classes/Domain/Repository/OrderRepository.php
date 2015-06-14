<?php
namespace WHO\WhoShop\Domain\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class OrderRepository
 * @package WHO\WhoShop\Domain\Repository
 */
class OrderRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @param int $id
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findById($id = 0) {
		$query= $this->createQuery();

		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('uid',$id));

		$test = $query->execute()->getFirst();;
		return $test;
	}

	public function findByOrderId($orderId = 0){
		$query = $this->createQuery();

		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('order_id', $orderId));

		return $query->execute();
	}

	public function findUnworkedOrders() {
		$query = $this->createQuery();

		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('state',1));

		return $query->execute();
	}


}