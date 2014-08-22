<?php

namespace Micro\auth;

/**
 * File RBAC class file.
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/antivir88/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package micro
 * @subpackage auth
 * @version 1.0
 * @since 1.0
 */
class FileRbac extends Rbac
{
    /** @var array $roles */
    private $roles = [];

    /**
     * Redefine constructor for RBAC
     *
     * @access public
     * @param array $params
     * @result void
     */
    public function __construct($params=[])
    {
        parent::__construct();

        if (isset($params['roles'])) {
            $this->roles = $this->tree($params['roles']);
        }
    }

    /**
     * Assign RBAC element into user
     *
     * @access public
     * @param integer $userId
     * @param string $name
     * @return bool
     */
    public function assign($userId, $name)
    {
        if ($this->searchRoleRecursive($this->roles, $name)) {
            if (!$this->conn->exists('rbac_user',['user'=>$userId, 'role'=>$name])) {
                return $this->conn->insert('rbac_user', ['role'=>$name, 'user'=>$userId]);
            }
        }
        return false;
    }

    /**
     * Get raw roles
     *
     * @access public
     * @return mixed
     */
    public function rawRoles()
    {
        return $this->roles;
    }
}