<?php
namespace In2\Femanager\Utility;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Reflection\Exception\PropertyNotAccessibleException;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;
use In2\Femanager\Domain\Model\User;
use In2\Femanager\Domain\Model\Log;

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
 * Misc Functions
 *
 * @package femanager
 * @license http://www.gnu.org/licenses/gpl.html
 * 			GNU General Public License, version 3 or later
 */
class Div {

	/**
	 * userRepository
	 *
	 * @var \In2\Femanager\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository;

	/**
	 * userGroupRepository
	 *
	 * @var \In2\Femanager\Domain\Repository\UserGroupRepository
	 * @inject
	 */
	protected $userGroupRepository;

	/**
	 * logRepository
	 *
	 * @var \In2\Femanager\Domain\Repository\LogRepository
	 * @inject
	 */
	protected $logRepository;

	/**
	 * configurationManager
	 *
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * objectManager
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager;

	/**
	 * Content Object
	 *
	 * @var object
	 */
	public $cObj;

	/**
	 * Return current logged in fe_user
	 *
	 * @return User
	 */
	public function getCurrentUser() {
		if (!is_array($GLOBALS['TSFE']->fe_user->user)) {
			return NULL;
		}
		return $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
	}

	/**
	 * Get Usergroups from current logged in user
	 *
	 * @return array
	 */
	public function getCurrentUsergroupUids() {
		$currentLoggedInUser = $this->getCurrentUser();
		$usergroupUids = array();
		if ($currentLoggedInUser !== NULL) {
			foreach ($currentLoggedInUser->getUsergroup() as $usergroup) {
				$usergroupUids[] = $usergroup->getUid();
			}
		}
		return $usergroupUids;
	}

	/**
	 * Set object properties from forceValues in TypoScript
	 *
	 * @param object $object
	 * @param array $settings
	 * @param ContentObjectRenderer $cObj
	 * @return object|User $object
	 */
	public function forceValues($object, $settings, $cObj) {
		foreach ((array) $settings as $field => $config) {
			$config = NULL;
			if (stristr($field, '.')) {
				continue;
			}

			// value to set
			$value = $cObj->cObjGetSingle($settings[$field], $settings[$field . '.']);

			if ($field === 'usergroup') {
				// need objectstorage for usergroup field
				$object->removeAllUsergroups();
				$values = GeneralUtility::trimExplode(',', $value, 1);
				foreach ($values as $usergroupUid) {
					$usergroup = $this->userGroupRepository->findByUid($usergroupUid);
					$object->addUsergroup($usergroup);
				}
			} else {
				// set value
				if (method_exists($object, 'set' . ucfirst($field))) {
					$object->{'set' . ucfirst($field)}($value);
				}
			}
		}
		return $object;
	}

	/**
	 * Autogenerate username and password if it's empty
	 *
	 * @param User $user
	 * @return User $user
	 */
	public function fallbackUsernameAndPassword(User $user) {
		$settings = $this->configurationManager->getConfiguration(
			ConfigurationManager::CONFIGURATION_TYPE_SETTINGS
		);
		if (!$user->getUsername()) {
			$user->setUsername(
				self::getRandomString(
					$settings['new']['misc']['autogenerate']['username']['length'],
					$settings['new']['misc']['autogenerate']['username']['addUpperCase'],
					$settings['new']['misc']['autogenerate']['username']['addSpecialCharacters']
				)
			);
			if ($user->getEmail()) {
				$user->setUsername(
					$user->getEmail()
				);
			}
		}
		if (!$user->getPassword()) {
			$password = self::getRandomString(
				$settings['new']['misc']['autogenerate']['password']['length'],
				$settings['new']['misc']['autogenerate']['password']['addUpperCase'],
				$settings['new']['misc']['autogenerate']['password']['addSpecialCharacters']
			);
			$user->setPassword($password);
			$user->setPasswordAutoGenerated($password);
		}
		return $user;
	}

	/**
	 * Overwrite usergroups from user by flexform settings
	 *
	 * @param User $object
	 * @param array $settings
	 * @param string $controllerName
	 * @return User $object
	 */
	public function overrideUserGroup($object, $settings, $controllerName = 'new') {
		if (empty($settings[$controllerName]['overrideUserGroup'])) {
			return $object;
		}

		// for each selected usergroup in the flexform
		$object->removeAllUsergroups();
		foreach (GeneralUtility::trimExplode(',', $settings[$controllerName]['overrideUserGroup'], 1) as $usergroupUid) {
			$usergroup = $this->userGroupRepository->findByUid($usergroupUid);
			$object->addUsergroup($usergroup);
		}

		return $object;
	}

	/**
	 * Upload file from $_FILES['qqfile']
	 *
	 * @return mixed false or filename like "file.png"
	 */
	public function uploadFile() {
		if (!is_array($_FILES['qqfile'])) {
			return FALSE;
		}
		if (empty($_FILES['qqfile']['name']) || !self::checkExtension($_FILES['qqfile']['name'])) {
			return FALSE;
		}

		// create new filename and upload it
		$basicFileFunctions = $this->objectManager->get('TYPO3\\CMS\\Core\\Utility\\File\\BasicFileUtility');
		$filename = $this->cleanFileName($_FILES['qqfile']['name']);
		$newFile = $basicFileFunctions->getUniqueName(
			$filename,
			GeneralUtility::getFileAbsFileName(
				self::getUploadFolderFromTca()
			)
		);
		if (GeneralUtility::upload_copy_move($_FILES['qqfile']['tmp_name'], $newFile)) {
			$fileInfo = pathinfo($newFile);
			return $fileInfo['basename'];
		}

		return FALSE;
	}

	/**
	 * Only allowed a-z, A-Z, 0-9, -, .
	 * Others will be replaced
	 *
	 * @param string $filename
	 * @param string $replace
	 * @return string
	 */
	public function cleanFileName($filename, $replace = '_') {
		return preg_replace('/[^a-zA-Z0-9-\.]/', $replace, trim($filename));
	}

	/**
	 * Check extension of given filename
	 *
	 * @param string $filename Filename like (upload.png)
	 * @return bool If Extension is allowed
	 */
	public static function checkExtension($filename) {
		$extensionList = 'jpg,jpeg,png,gif,bmp';
		if (!empty($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_femanager.']['settings.']['misc.']['uploadFileExtension'])) {
			$extensionList = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_femanager.']['settings.']['misc.']['uploadFileExtension'];
			$extensionList = str_replace(' ', '', $extensionList);
		}
		$fileInfo = pathinfo($filename);

		if (
			!empty($fileInfo['extension']) &&
			GeneralUtility::inList($extensionList, strtolower($fileInfo['extension'])) &&
			GeneralUtility::verifyFilenameAgainstDenyPattern($filename) &&
			GeneralUtility::validPathStr($filename)
		) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Hash a password from $user->getPassword()
	 *
	 * @param FrontendUser $user
	 * @param string $method "md5" or "sha1"
	 * @return void
	 */
	public static function hashPassword(&$user, $method) {
		switch ($method) {
			case 'md5':
				$user->setPassword(md5($user->getPassword()));
				break;

			case 'sha1':
				$user->setPassword(sha1($user->getPassword()));
				break;

			default:
				if (ExtensionManagementUtility::isLoaded('saltedpasswords')) {
					if (SaltedPasswordsUtility::isUsageEnabled('FE')) {
						$objInstanceSaltedPw = SaltFactory::getSaltingInstance();
						$user->setPassword($objInstanceSaltedPw->getHashedPassword($user->getPassword()));
					}
				}
		}
	}

	/**
	 * Checks if object was changed or not
	 *
	 * @param $object
	 * @return bool
	 */
	public static function isDirtyObject($object) {
		foreach (array_keys($object->_getProperties()) as $propertyName) {
			try {
				$property = ObjectAccess::getProperty($object, $propertyName);
			} catch (PropertyNotAccessibleException $e) {
				// if property can not be accessed
				continue;
			}

			/**
			 * std::Property (string, int, etc..),
			 * PHP-Objects (DateTime, RecursiveIterator, etc...),
			 * TYPO3-Objects (user, page, etc...)
			 */
			if (!$property instanceof ObjectStorage) {
				if ($object->_isDirty($propertyName)) {
					return TRUE;
				}
			} else {
				/**
				 * ObjectStorage
				 */
				if ($property->_isDirty()) {
					return TRUE;
				}
			}
		}
		return FALSE;
	}

	/**
	 * Get changed properties (compare two objects with same getter methods)
	 *
	 * @param User $changedObject
	 * @return array
	 * 			[firstName][old] = Alex
	 * 			[firstName][new] = Alexander
	 */
	public static function getDirtyPropertiesFromObject($changedObject) {
		$dirtyProperties = array();
		$ignoreProperties = array(
			'txFemanagerChangerequest',
			'ignoreDirty',
			'isOnline',
			'lastlogin'
		);

		foreach ($changedObject->_getCleanProperties() as $propertyName => $oldPropertyValue) {
			if (!method_exists($changedObject, 'get' . ucfirst($propertyName)) || in_array($propertyName, $ignoreProperties)) {
				continue;
			}
			$newPropertyValue = $changedObject->{'get' . ucfirst($propertyName)}();
			if (!is_object($oldPropertyValue) || !is_object($newPropertyValue)) {
				if ($oldPropertyValue != $newPropertyValue) {
					$dirtyProperties[$propertyName]['old'] = $oldPropertyValue;
					$dirtyProperties[$propertyName]['new'] = $newPropertyValue;
				}
			} else {
				if (get_class($oldPropertyValue) === 'DateTime') {
					if ($oldPropertyValue->getTimestamp() != $newPropertyValue->getTimestamp()) {
						$dirtyProperties[$propertyName]['old'] = $oldPropertyValue->getTimestamp();
						$dirtyProperties[$propertyName]['new'] = $newPropertyValue->getTimestamp();
					}
				} else {
					$titlesOld = self::implodeObjectStorageOnProperty($oldPropertyValue);
					$titlesNew = self::implodeObjectStorageOnProperty($newPropertyValue);
					if ($titlesOld != $titlesNew) {
						$dirtyProperties[$propertyName]['old'] = $titlesOld;
						$dirtyProperties[$propertyName]['new'] = $titlesNew;
					}
				}
			}
		}
		return $dirtyProperties;
	}

	/**
	 * overwrite user with old values and xml with new values
	 *
	 * @param User $user
	 * @param array $dirtyProperties
	 * @return User $user
	 */
	public static function rollbackUserWithChangeRequest($user, $dirtyProperties) {
		$existingUserProperties = $user->_getCleanProperties();

		// reset old values
		$user->setUserGroup($existingUserProperties['usergroup']);
		foreach ($dirtyProperties as $propertyName => $propertyValue) {
			$propertyValue = NULL;
			$user->{'set' . ucfirst($propertyName)}($existingUserProperties[$propertyName]);
		}

		// store changes as xml in field fe_users.tx_femanager_changerequest
		$user->setTxFemanagerChangerequest(
			GeneralUtility::array2xml($dirtyProperties, '', 0, 'changes')
		);

		return $user;
	}

	/**
	 * Implode subjobjects on a property (example for usergroups: "ug1, ug2, ug3")
	 *
	 * @param object $objectStorage
	 * @param string $property
	 * @param string $glue
	 * @return string
	 */
	public static function implodeObjectStorageOnProperty($objectStorage, $property = 'uid', $glue = ', ') {
		$value = '';
		foreach ($objectStorage as $object) {
			if (method_exists($object, 'get' . ucfirst($property))) {
				$value .= $object->{'get' . ucfirst($property)}();
				$value .= $glue;
			}
		}
		return substr($value, 0, (strlen($glue) * -1));
	}

	/**
	 * Determine if supplied string is a valid MD5 Hash
	 *
	 * @param string $md5 String to validate
	 * @return boolean
	 */
	public static function isMd5($md5) {
		return !empty($md5) && preg_match('/^[a-f0-9]{32}$/', $md5);
	}

	/**
	 * @param string $title Title to log
	 * @param int $state State to log
	 * @param User $user Related User
	 * @return void
	 */
	public function log($title, $state, User $user) {
		// Disable Log
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['femanager']);
		if (!empty($confArr['disableLog'])) {
			return;
		}

		/* @var $log Log */
		$log = $this->objectManager->get('In2\\Femanager\\Domain\\Model\\Log');
		$log->setTitle($title);
		$log->setState($state);
		$log->setUser($user);
		$this->logRepository->add($log);
	}

	/**
	 * Create Hash from String and TYPO3 Encryption Key (if available)
	 *
	 * @param string $string Any String to hash
	 * @param int $length Hash Length
	 * @return string $hash Hashed String
	 */
	public static function createHash($string, $length = 10) {
		if (!empty($GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'])) {
			$hash = GeneralUtility::shortMD5($string . $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'], $length);
		} else {
			$hash = GeneralUtility::shortMD5($string, $length);
		}
		return $hash;
	}

	/**
	 * Create array for swiftmailer
	 * 		sender and receiver mail/name combination with fallback
	 *
	 * @param string $emailString String with separated emails (splitted by \n)
	 * @param string $name Name for every email name combination
	 * @return array $mailArray
	 */
	public static function makeEmailArray($emailString, $name = 'femanager') {
		$emails = GeneralUtility::trimExplode("\n", $emailString, 1);
		$mailArray = array();
		foreach ($emails as $email) {
			if (!GeneralUtility::validEmail($email)) {
				continue;
			}
			$mailArray[$email] = $name;
		}
		return $mailArray;
	}

	/**
	 * Read values between brackets
	 *
	 * @param string $value
	 * @return string
	 */
	public static function getValuesInBrackets($value = 'test(1,2,3)') {
		preg_match_all( '/\(.*?\)/i', $value, $result);
		return str_replace(array('(', ')'), '', $result[0][0]);
	}

	/**
	 * Read values before brackets
	 *
	 * @param string $value
	 * @return string
	 */
	public static function getValuesBeforeBrackets($value = 'test(1,2,3)') {
		$valueParts = GeneralUtility::trimExplode('(', $value, 1);
		return $valueParts[0];
	}

	/**
	 * SendPost - Send values via curl to target
	 *
	 * @param User $user User properties
	 * @param array $config TypoScript Settings
	 * @param ContentObjectRenderer $contentObject
	 * @return void
	 */
	public static function sendPost($user, $config, $contentObject) {
		// stop if turned off
		if (!$contentObject->cObjGetSingle($config['new.']['sendPost.']['_enable'], $config['new.']['sendPost.']['_enable.'])) {
			return;
		}

		$properties = $user->_getCleanProperties();
		$contentObject->start($properties);
		$curl = array(
			'url' => $config['new.']['sendPost.']['targetUrl'],
			'data' => $contentObject->cObjGetSingle($config['new.']['sendPost.']['data'], $config['new.']['sendPost.']['data.']),
			'properties' => $properties
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $curl['url']);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curl['data']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_exec($ch);
		curl_close($ch);

		// Debug Output
		if ($config['new.']['sendPost.']['debug']) {
			GeneralUtility::devLog('femanager sendpost values', 'femanager', 0, $curl);
		}
	}

	/**
	 * Store user values in any database table
	 *
	 * @param User $user User properties
	 * @param array $config TypoScript Settings
	 * @param ContentObjectRenderer $contentObject
	 * @param ObjectManagerInterface $objectManager
	 * @return void
	 */
	public static function storeInDatabasePreflight($user, $config, $contentObject, $objectManager) {
		$uid = 0;
		if (empty($config['new.']['storeInDatabase.'])) {
			return;
		}

		// one loop for every table to store
		foreach ((array) $config['new.']['storeInDatabase.'] as $table => $storeSettings) {
			$storeSettings = NULL;
			// if turned off
			if (
				!$contentObject->cObjGetSingle(
					$config['new.']['storeInDatabase.'][$table]['_enable'],
					$config['new.']['storeInDatabase.'][$table]['_enable.']
				)
			) {
				continue;
			}
			// push user values to TypoScript to use with ".field=username"
			$contentObject->start(array_merge($user->_getProperties(), array('lastGeneratedUid' => $uid)));

			/**
			 * @var $storeInDatabase \In2\Femanager\Utility\StoreInDatabase
			 */
			$storeInDatabase = $objectManager->get('In2\\Femanager\\Utility\\StoreInDatabase');
			$storeInDatabase->setTable($table);
			foreach ($config['new.']['storeInDatabase.'][$table] as $field => $value) {
				if ($field[0] === '_' || stristr($field, '.')) {
					continue;
				}
				$value = $contentObject->cObjGetSingle(
					$config['new.']['storeInDatabase.'][$table][$field],
					$config['new.']['storeInDatabase.'][$table][$field . '.']
				);
				$storeInDatabase->addProperty($field, $value);
			}
			$uid = $storeInDatabase->execute();
		}
	}

	/**
	 * Remove FE Session to a given user
	 *
	 * @param FrontendUser $user
	 * @return void
	 */
	public static function removeFrontendSessionToUser(FrontendUser $user) {
		$GLOBALS['TYPO3_DB']->exec_DELETEquery('fe_sessions', 'ses_userid = ' . intval($user->getUid()));
	}

	/**
	 * Check if FE Session exists
	 *
	 * @param FrontendUser $user
	 * @return bool
	 */
	public static function checkFrontendSessionToUser(FrontendUser $user) {
		$select = 'ses_id';
		$from = 'fe_sessions';
		$where = 'ses_userid = ' . intval($user->getUid());
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select, $from, $where);
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		if (!empty($row['ses_id'])) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * createRandomFileName
	 *
	 * @param int $length
	 * @param bool $addUpperCase
	 * @param bool $addSpecialCharacters
	 * @return string
	 */
	public static function getRandomString($length = 32, $addUpperCase = TRUE, $addSpecialCharacters = TRUE) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		if ($addUpperCase) {
			$characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}
		if ($addSpecialCharacters) {
			$characters .= '#+*&%$§()[]{}!.:-_,;';
		}
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$key = mt_rand(0, strlen($characters) - 1);
			$string .= $characters[$key];
		}
		return $string;
	}

	/**
	 * Read fe_users image uploadfolder from TCA
	 *
	 * @return string path - standard "uploads/pics"
	 */
	public static function getUploadFolderFromTca() {
		$path = $GLOBALS['TCA']['fe_users']['columns']['image']['config']['uploadfolder'];
		if (empty($path)) {
			$path = 'uploads/pics';
		}
		return $path;
	}

	/**
	 * Get absolute path for templates with fallback
	 * 		In case of multiple paths this will just return the first one.
	 * 		See getTemplateFolders() for an array of paths.
	 *
	 * @param string $part "template", "partial", "layout"
	 * @return string
	 * @see getTemplateFolders()
	 */
	public function getTemplateFolder($part = 'template') {
		$matches = $this->getTemplateFolders($part);
		return !empty($matches) ? $matches[0] : '';
	}

	/**
	 * Get absolute paths for templates with fallback
	 * 		Returns paths from *RootPaths and *RootPath and "hardcoded"
	 * 		paths pointing to the EXT:femanager-resources.
	 *
	 * @param string $part "template", "partial", "layout"
	 * @param boolean $returnAllPaths Default: FALSE, If FALSE only paths
	 * 		for the first configuration (Paths, Path, hardcoded)
	 * 		will be returned. If TRUE all (possible) paths will be returned.
	 * @return array
	 */
	public function getTemplateFolders($part = 'template', $returnAllPaths = FALSE) {
		$templatePaths = array();
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
			ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
		);
		if (!empty($extbaseFrameworkConfiguration['view'][$part . 'RootPaths'])) {
			$templatePaths = $extbaseFrameworkConfiguration['view'][$part . 'RootPaths'];
			krsort($templatePaths);
			$templatePaths = array_values($templatePaths);
		}
		if ($returnAllPaths || empty($templatePaths)) {
			$path = $extbaseFrameworkConfiguration['view'][$part . 'RootPath'];
			if (!empty($path)) {
				$templatePaths[] = $path;
			}
		}
		if ($returnAllPaths || empty($templatePaths)) {
			$templatePaths[] = 'EXT:femanager/Resources/Private/' . ucfirst($part) . 's/';
		}
		$templatePaths = array_unique($templatePaths);
		$absoluteTemplatePaths = array();
		foreach ($templatePaths as $templatePath) {
			$absoluteTemplatePaths[] = GeneralUtility::getFileAbsFileName($templatePath);
		}
		return $absoluteTemplatePaths;
	}

	/**
	 * Return path and filename for a file or path.
	 * 		Only the first existing file/path will be returned.
	 * 		respect *RootPaths and *RootPath
	 *
	 * @param string $relativePathAndFilename e.g. Email/Name.html
	 * @param string $part "template", "partial", "layout"
	 * @return string Filename/path
	 */
	public function getTemplatePath($relativePathAndFilename, $part = 'template') {
		$matches = $this->getTemplatePaths($relativePathAndFilename, $part);
		return !empty($matches) ? $matches[0] : '';
	}

	/**
	 * Return path and filename for one or many files/paths.
	 * 		Only existing files/paths will be returned.
	 * 		respect *RootPaths and *RootPath
	 *
	 * @param string $relativePathAndFilename Path/filename (Email/Name.html) or path
	 * @param string $part "template", "partial", "layout"
	 * @return array All existing matches found
	 */
	public function getTemplatePaths($relativePathAndFilename, $part = 'template') {
		$absolutePathAndFilenameMatches = array();
		$absolutePaths = $this->getTemplateFolders($part, TRUE);
		foreach ($absolutePaths as $absolutePath) {
			if (file_exists($absolutePath . $relativePathAndFilename)) {
				$absolutePathAndFilenameMatches[] = $absolutePath . $relativePathAndFilename;
			}
		}
		return $absolutePathAndFilenameMatches;
	}
}
