<?php
namespace In2\Femanager\Domain\Validator;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use In2\Femanager\Domain\Model\User;
use In2\Femanager\Utility\Div;

/**
 * Class ClientsideValidator
 *
 * @package In2\Femanager\Domain\Validator
 */
class ClientsideValidator extends AbstractValidator {

	/**
	 * Validation settings string
	 * 		possible validations for each field are:
	 * 			required, email, min(12), max(13), intOnly, lettersOnly,
	 * 			uniqueInPage, uniqueInDb, date, mustInclude(number,letter,special),
	 * 			inList(1,2,3)
	 *
	 * @var string
	 */
	protected $validationSettingsString;

	/**
	 * Field Value
	 *
	 * @var string
	 */
	protected $value;

	/**
	 * Field Name
	 *
	 * @var string
	 */
	protected $fieldName;

	/**
	 * User
	 *
	 * @var User
	 */
	protected $user = NULL;

	/**
	 * Error message container
	 *
	 * @var array
	 */
	protected $messages = array();

	/**
	 * Additional Values (for comparing a value with another)
	 *
	 * @var string
	 */
	protected $additionalValue;

	/**
	 * Validate Field
	 *
	 * @return bool
	 */
	public function validateField() {
		$validationSettings = GeneralUtility::trimExplode(',', $this->validationSettingsString, 1);
		$validationSettings = str_replace('|', ',', $validationSettings);

		foreach ($validationSettings as $validationSetting) {

			switch ($validationSetting) {

				case 'required':
					if (!$this->validateRequired($this->getValue())) {
						$this->addMessage('validationErrorRequired');
						$this->isValid = FALSE;
					}
					break;

				case 'email':
					if ($this->getValue() && !$this->validateEmail($this->getValue())) {
						$this->addMessage('validationErrorEmail');
						$this->isValid = FALSE;
					}
					break;

				case stristr($validationSetting, 'min('):
					if ($this->getValue() && !$this->validateMin($this->getValue(), Div::getValuesInBrackets($validationSetting))) {
						$this->addMessage('validationErrorMin');
						$this->isValid = FALSE;
					}
					break;

				case stristr($validationSetting, 'max('):
					if ($this->getValue() && !$this->validateMax($this->getValue(), Div::getValuesInBrackets($validationSetting))) {
						$this->addMessage('validationErrorMax');
						$this->isValid = FALSE;
					}
					break;

				case 'intOnly':
					if ($this->getValue() && !$this->validateInt($this->getValue())) {
						$this->addMessage('validationErrorInt');
						$this->isValid = FALSE;
					}
					break;

				case 'lettersOnly':
					if ($this->getValue() && !$this->validateLetters($this->getValue())) {
						$this->addMessage('validationErrorLetters');
						$this->isValid = FALSE;
					}
					break;

				case 'uniqueInPage':
					if ($this->getValue() && !$this->validateUniquePage($this->getValue(), $this->getFieldName(), $this->getUser())) {
						$this->addMessage('validationErrorUniquePage');
						$this->isValid = FALSE;
					}
					break;

				case 'uniqueInDb':
					if ($this->getValue() && !$this->validateUniqueDb($this->getValue(), $this->getFieldName(), $this->getUser())) {
						$this->addMessage('validationErrorUniqueDb');
						$this->isValid = FALSE;
					}
					break;

				case stristr($validationSetting, 'mustInclude('):
					if ($this->getValue() && !$this->validateMustInclude($this->getValue(), Div::getValuesInBrackets($validationSetting))) {
						$this->addMessage('validationErrorMustInclude');
						$this->isValid = FALSE;
					}
					break;

				case stristr($validationSetting, 'mustNotInclude('):
					if ($this->getValue() && !$this->validateMustNotInclude($this->getValue(), Div::getValuesInBrackets($validationSetting))) {
						$this->addMessage('validationErrorMustNotInclude');
						$this->isValid = FALSE;
					}
					break;

				case stristr($validationSetting, 'inList('):
					if (!$this->validateInList($this->getValue(), Div::getValuesInBrackets($validationSetting))) {
						$this->addMessage('validationErrorInList');
						$this->isValid = FALSE;
					}
					break;

				case stristr($validationSetting, 'sameAs('):
					if (!$this->validateSameAs($this->getValue(), $this->getAdditionalValue())) {
						$this->addMessage('validationErrorSameAs');
						$this->isValid = FALSE;
					}
					break;

				case 'date':
					if (
						$this->getValue() &&
						!$this->validateDate(
							$this->getValue(),
							LocalizationUtility::translate('tx_femanager_domain_model_user.dateFormat', 'femanager')
						)
					) {
						$this->addMessage('validationErrorDate');
						$this->isValid = FALSE;
					}
					break;

				default:
					// e.g. search for method validateCustom()
					if (method_exists($this, 'validate' . ucfirst(Div::getValuesBeforeBrackets($validationSetting)))) {
						if (
							!$this->{'validate' . ucfirst(Div::getValuesBeforeBrackets($validationSetting))}(
								$this->getValue(),
								Div::getValuesInBrackets($validationSetting)
							)
						) {
							$this->addMessage('validationError' . ucfirst(Div::getValuesBeforeBrackets($validationSetting)));
							$this->isValid = FALSE;
						}
					}
			}
		}

		return $this->isValid;
	}

	/**
	 * Set validation
	 *
	 * @param string $validationSettingsString
	 * @return ClientsideValidator
	 */
	public function setValidationSettingsString($validationSettingsString) {
		$this->validationSettingsString = $validationSettingsString;
		return $this;
	}

	/**
	 * Get validation
	 *
	 * @return string
	 */
	public function getValidationSettingsString() {
		return $this->validationSettingsString;
	}

	/**
	 * @param string $value
	 * @return ClientsideValidator
	 */
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Add a message to the errormessage array
	 *
	 * @param string $message
	 * @return void
	 */
	public function addMessage($message) {
		$this->messages = array_merge($this->messages, array($message));
	}

	/**
	 * @param array $messages
	 * @return ClientsideValidator
	 */
	public function setMessages($messages) {
		$this->messages = $messages;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * @param string $fieldName
	 * @return ClientsideValidator
	 */
	public function setFieldName($fieldName) {
		$this->fieldName = $fieldName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFieldName() {
		return $this->fieldName;
	}

	/**
	 * @param User $user
	 * @return ClientsideValidator
	 */
	public function setUser(User $user = NULL) {
		$this->user = $user;
		return $this;
	}

	/**
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param string $additionalValue
	 * @return ClientsideValidator
	 */
	public function setAdditionalValue($additionalValue) {
		$this->additionalValue = $additionalValue;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAdditionalValue() {
		return $this->additionalValue;
	}
}