<?php

namespace CMS\User;

use CMS\Entity\User\Role;

/**
 * IRoleModel
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IRoleModel
{
    /**#@+ Exception error code */
	const ERROR_ROLE_EXISTS = 1;
	/**#@-*/

    /**
     * Add new role to database
     * @param Role $role
     */
    public function add(Role $role);

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
     *
     * @param array
     */
    public function getByName($name);

    /**
     * Test uniqueness of name
     * @param string $email
     * @return bool
     */
    public function nameExists($name);

}

