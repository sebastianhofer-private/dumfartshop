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

	/**
	 * @param array $uidList
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByUidList($uidList = array()){
		if(empty($uidList)){
			return FALSE;
		}
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching(
			$query->in('uid',$uidList)
		);

		return $query->execute();
	}

	public function findById($uid) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);

		$query->matching($query->equals('uid', $uid));

		return $query->execute();
	}

	public function findByCatList($catList){
		$query = $this->createQuery();
		$catCommaList='';
		$firstRun=TRUE;

		foreach($catList as $cat){
			if($firstRun){
				$catCommaList .= $cat;
			}else{
				$catCommaList .= ',' . $cat;
			}
			$firstRun=FALSE;
		}

		$query->statement(
			'SELECT * FROM tx_whoshop_domain_model_product AS prod LEFT JOIN sys_category_record_mm AS mm ON prod.uid=mm.uid_foreign WHERE mm.uid_local IN('. $catCommaList .') AND prod.hidden=0 AND prod.deleted=0 GROUP BY prod.uid LIMIT 8'
		);

		return $query->execute();
	}
}