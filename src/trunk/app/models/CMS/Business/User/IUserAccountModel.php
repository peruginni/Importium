<?php

namespace CMS\User;

use CMS\Entity\User\UserAccount;

/**
 * IUserAccountModel
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IUserAccountModel extends \Nette\Security\IAuthenticator
{
    /**#@+ Exception error code */
	const ERROR_USERNAME_EXISTS = 1;
	const ERROR_EMAIL_EXISTS = 2;
	/**#@-*/

    /**
     * Add new user account to database
     * @param UserAccount $userAccount 
     */
    public function add(UserAccount $userAccount);

    /**
     * Save changes made to existing user account
     * @param UserAccount $userAccount 
     */
    public function edit(UserAccount $userAccount);

    /**
     * Remove existing user account
     * @param UserAccount $userAccount 
     */
    public function delete(UserAccount $userAccount);

    /**
     * Get full entity from database
     * @param UserAccount $userAccount partial entity (with id)
     * @return UserAccount
     */
    public function get(UserAccount $userAccount);

    /**
     * Get all user accounts
     * @return array
     */
    public function getAll();

    /**
     * Get users with given role
     * @param Role $role
     * @return array
     */
    public function getByRole(Role $role);

    /**
     * Get entity from database by username and password
     * @param string $username
     * @param string $password
     * @return UserAccount
     */
    public function getByCredentials($username, $password);

    /**
     * Change password for existing user account 
     * @param UserAccount $userAccount
     * @param string $newPassword
     */
    public function changePassword(UserAccount $userAccount, $newPassword);

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

