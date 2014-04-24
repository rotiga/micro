<?php

/**
 * MFlashMessage is a flash messenger.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license http://opensource.org/licenses/MIT
 * @package micro
 * @subpackage web
 * @subpackage helpers
 * @version 1.0
 * @since 1.0
 */
class MFlashMessage
{
	const TYPE_SUCCESS = 1;
	const TYPE_NOTICE = 2;
	const TYPE_ERROR = 3;

	/**
	 * Constructor messenger
	 *
	 * @access public
	 * @result void
	 * @catch MException
	 */
	public function __construct() {
		try {
			MRegistry::get('session')->flash = array();
		} catch (MException $e) {
			die('Механизм сессий не активирован: ' . $e->getMessage());
		}
	}

	/**
	 * Push a new flash
	 *
	 * @access public
	 * @param int $type
	 * @param string $title
	 * @param string $description
	 * @return void
	 */
	public function push($type = MFlashMessage::TYPE_SUCCESS, $title = '', $description = '') {
		MRegistry::get('session')->flash[] = array(
			'type'=> $type,
			'title'=> $title,
			'description'=> $description
		);
	}
	/**
	 * Has flashes by type
	 *
	 * @access public
	 * @param int $type
	 * @return bool
	 */
	public function has($type = MFlashMessage::TYPE_SUCCESS) {
		foreach (MRegistry::get('session')->flash AS $element) {
			if (isset($element['type']) && $element['type'] == $type) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Get flash by type
	 *
	 * @access public
	 * @param int $type
	 * @return array|bool
	 */
	public function get($type = MFlashMessage::TYPE_SUCCESS) {
		foreach (MRegistry::get('session')->flash AS $key=>$element) {
			if (isset($element['type']) && $element['type'] == $type) {
				$result = $element;
				unset(MRegistry::get('session')->flash[$key]);
				return $result;
			}
		}
		return false;
	}

	/**
	 * Get all flashes
	 *
	 * @access public
	 * @return mixed
	 */
	public function getAll() {
		$result = MRegistry::get('session')->flash;
		MRegistry::get('session')->flash = array();
		return $result;
	}
}