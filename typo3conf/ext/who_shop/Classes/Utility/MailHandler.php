<?php
namespace WHO\WhoShop\Utility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Sebastian Hofer <sebastian.hofer@s-hofer.de>
 *
 *  All rights reserved
 *
 ***************************************************************/
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class MailHandler
 * @package WHO\WhoShop\Utility
 */
class MailHandler implements SingletonInterface {


	/**
	 * @param $receiverMail
	 * @param $senderMail
	 * @param $subject
	 * @param $content
	 */
	public function sendMailToCustomer($receiverMail, $senderMail, $subject, $content){
		$this->sendMail($receiverMail, $senderMail, $subject, $content);
	}


	/**
	 * @param $receiverMail
	 * @param $senderMail
	 * @param $subject
	 * @param $content
	 */
	public function sendMailToSeller($receiverMail, $senderMail, $subject, $content){
		$this->sendMail($receiverMail, $senderMail, $subject, $content);
	}

	/**
	 * @param $receiver
	 * @param $sender
	 * @param $subject
	 * @param $content
	 */
	public function sendOrderMails($receiver, $sender, $subject, $content){
		$this->sendMail($receiver, $sender, $subject, $content);
	}

	/**
	 * @param $receiver
	 * @param $sender
	 * @param $subject
	 * @param $content
	 * @param string $receiverName
	 * @param string $senderName
	 *
	 * @return mixed
	 */
	private function sendMail($receiver, $sender, $subject, $content, $receiverName='', $senderName='Dumfart-Shop'){

		$message = GeneralUtility::makeInstance('\TYPO3\CMS\Core\Mail\MailMessage');

		$message
			->setTo(array($receiver => $receiverName))
			->setFrom(array($sender => $senderName))
			->setSubject($subject)
			->setCharset($GLOBALS['TSFE']->metaCharset);
		$message->addPart(
			$this->makePlain($content),
			'text/plain'
		);

		/*
		if (file_exists(GeneralUtility::getFileAbsFileName($file))) {
			$message->attach(\Swift_Attachment::fromPath($file));
		} else {
			GeneralUtility::devLog('Error: File to attach does not exist', 'who_shop', 2, $file);
		}
*/
		$message->send();

		return $message->isSent();
	}

	/**
	 * Function makePlain() removes html tags and add linebreaks
	 * 		Easy generate a plain email bodytext from a html bodytext
	 *
	 * stolen from powermail extension ;-)
	 *
	 * @param string $content: HTML Mail bodytext
	 * @return string $content: Plain Mail bodytext
	 */
	protected function makePlain($content) {
		// config

		// This tags will be added with linebreaks
		$htmltagarray = array (
			'</p>',
			'</tr>',
			'</li>',
			'</h1>',
			'</h2>',
			'</h3>',
			'</h4>',
			'</h5>',
			'</h6>',
			'</div>',
			'</legend>',
			'</fieldset>',
			'</dd>',
			'</dt>'
		);
		// This array contains not allowed signs which will be removed
		$notallowed = array (
			'&nbsp;',
			'&szlig;',
			'&Uuml;',
			'&uuml;',
			'&Ouml;',
			'&ouml;',
			'&Auml;',
			'&auml;',
		);

		$content = nl2br($content);
		// 1. add linebreaks on some parts (</p> => </p><br />)
		$content = str_replace($htmltagarray, $htmltagarray[0] . '<br />', $content);
		// 2. remove all tags (<b>bla</b><br /> => bla<br />)
		$content = strip_tags($content, '<br><address>');
		// 3. removes tabs and whitespaces
		$content = preg_replace('/\s+/', ' ', $content);
		// 4. <br /> to \n
		$content = $this->br2nl($content);
		// 5. explode and trim and implode again (" bla \n blabla " => "bla\nbla")
		$content = implode("\n", GeneralUtility::trimExplode("\n", $content));
		// 6. remove not allowed signs
		$content = str_replace($notallowed, '', $content);

		return $content;
	}

	/**
	 * Function br2nl is the opposite of nl2br
	 *
	 * stolen from powermail extension ;-)
	 *
	 * @param string $content: Anystring
	 * @return string $content: Manipulated string
	 */
	protected function br2nl($content) {
		$array = array(
			'<br >',
			'<br>',
			'<br/>',
			'<br />'
		);
		// replacer
		$content = str_replace($array, "\n", $content);

		return $content;
	}
}