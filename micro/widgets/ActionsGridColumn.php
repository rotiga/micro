<?php /** MicroActionsGridColumn */

namespace Micro\widgets;

use Micro\web\helpers\Html;

/**
 * ActionsGridColumn class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @subpackage widgets
 * @version 1.0
 * @since 1.0
 */
class ActionsGridColumn extends GridColumn
{
    /**
     * Convert object to string
     *
     * @access public
     * @return mixed
     */
    public function __toString()
    {
        if (!isset($this->params['link']) OR empty($this->params['link'])) {
            return 'Link for actions column not defined!';
        }
        if (!isset($this->params['template']) OR empty($this->params['template'])) {
            $this->params['template'] = '{view} {edit} {delete}';
        }

        $r = Html::href(
            'view',
            $this->params['link'].'/'.$this->params['key']
        );
        $w = Html::href(
            'edit',
            $this->params['link'].'/edit/'.$this->params['key']
        );
        $d = Html::href(
            'delete',
            $this->params['link'].'/delete/'.$this->params['key'],
            ['onclick'=>'Are you sure?']
        );

        return str_replace('view', $r, str_replace('{edit}', $w,
            str_replace('{delete}', $d, $this->params['template'])
        ));
    }
}