<?php /** MicroEmailLogger */

namespace Micro\loggers;

use Micro\web\helpers\Mail;

/**
 * Email logger class file.
 *
 * Sender email for logger
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @subpackage loggers
 * @version 1.0
 * @since 1.0
 */
class EmailLogger extends LogInterface
{
    /** @var string $from email for sender attribute */
    private $from;
    /** @var string $type message attribute */
    private $type = 'text/plain';
    /** @var string $to message recipient */
    private $to;
    /** @var string $subject message theme */
    private $subject;

    /**
     * Constructor initialize logger
     *
     * @access public
     * @param array $params
     * @result void
     */
    public function __construct($params=[])
    {
        parent::__construct($params);

        $this->from = isset($params['from']) ? $params['from'] : getenv("SERVER_ADMIN");
        $this->to = isset($params['to']) ? $params['to'] : $this->from;
        $this->subject = isset($params['subject']) ? $params['subject'] : $_SERVER['SERVER_NAME'].' log message';
    }

    /**
     * Send log message
     *
     * @access public
     * @param $level
     * @param $message
     * @return void
     */
    public function sendMessage($level, $message)
    {
        $mail = new Mail($this->from);
        $mail->setType($this->type);
        $mail->send($this->to, $this->subject, ucfirst($level).': '.$message );
    }
}