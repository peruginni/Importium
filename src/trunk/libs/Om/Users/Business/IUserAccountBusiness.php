<?php

namespace Om\Users;

use Om\Core\IBaseBusiness;


/**
 * Interface for user account business object
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IUserAccountBusiness extends IBaseBusiness
{

	/**#@+ error codes */
	const USERNAME_EXISTS = 11;
	const EMAIL_EXISTS = 12;
	/**#@-*/
	

	/**
	 * Detect if user account with given username exists
	 *
	 * @param string $username
	 * @return bool
	 */
	public function usernameExists($username);



	/**
	 * Detect if user account with given email exists
	 *
	 * @param string $email
	 * @return bool
	 */
	public function emailExists($email);



	/**
	 * Sign up new user account
	 *
	 * @param UserAccount $userAccount
	 */
	public function signUp(UserAccount $userAccount);



	/**
	 * Save changes for existing account. Will check if username and email
	 * were not changed.
	 *
	 * @param UserAccount $userAccount
	 */
	public function saveChanges(UserAccount $changedEntity);



	/**
	 * Change password for given user account
	 *
	 * @param UserAccount $userAccount
	 * @param string $newPassword
	 */
	public function changePassword(UserAccount $userAccount, $newPassword);

}

