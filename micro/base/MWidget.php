<?php /** MicroWidget */

/**
 * MWidget class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license http://opensource.org/licenses/MIT
 * @package micro
 * @version 1.0
 * @since 1.0
 */
abstract class MWidget extends MController
{
	/**
	 * Constructor for widgets
	 *
	 * @access public
	 * @param array $args
	 * @result void
	 */
	public function __construct($args = array()) {
		foreach ($args AS $name => $value) {
			$this->$name = $value;
		}

		$this->asWidget = true;
	}
	/**
	 * Initialize widget
	 * @abstract
	 */
	abstract public function init();
	/**
	 * Run widget
	 * @abstract
	 */
	abstract public function run();
}