<?php
namespace WHO\WhoShop\Domain\Repository;

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
 * Class UserRepository
 * @package WHO\WhoShop\Domain\Repository
 */
class UserRepository extends \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository {

	/**
	 * @param int $id
	 * @return object
	 */
	public function findById($id = 0) {
		$query= $this->createQuery();

		$ignoreFields = array('tx_extbase_type');
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setIgnoreEnableFields(TRUE);
		$query->getQuerySettings()->setEnableFieldsToBeIgnored($ignoreFields);
		$query->matching($query->equals('uid',$id));

		$test = $query->execute()->getFirst();;
		return $test;
	}
}
