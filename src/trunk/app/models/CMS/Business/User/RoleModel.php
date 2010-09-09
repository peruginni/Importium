<?php

namespace CMS\User;

use CMS;

class RoleModel extends \CMS\BaseModel  implements IRoleModel
{

    /**
     * Add new role to database
     * @param Role $role
     */
    public function add(Role $role)
    {
        
    }

    /**
     * Save changes made to existing role
     * @param Role $role
     */
    public function edit(Role $role);

    /**
     * Remove existing role
     * @param Role $role
     */
    public function delete(Role $role);

    /**
     * Get full entity from database
     * @param Role $role entity with id
     * @return Role
     */
    public function get(Role $role);

    /**
     * Get entity from database by username and password
     * @param string $username
     * @param string $password
     * @return Role
     */
    public function getByName($roleName);

    /**
     * Change password for existing role
     * @param Role $role
     * @param string $newPassword
     */
    public function changePassword(Role $role, $newPassword);

    /**
     * Test uniqueness of username
     * @param string $username
     * @return bool
     */
    public function usernameExists($username);

    /**
     * Test uniqueness of email
     * @param string $email
     * @return bool
     */
    public function emailExists($email);

}
