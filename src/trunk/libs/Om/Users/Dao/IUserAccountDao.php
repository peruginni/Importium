<?php

namespace Om\Users;

use Om\Core\IBaseDao;

/**
 * Interface for user account DAO
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IUserAccountDao extends IBaseDao
{

	/**
	 * Detect if username exists
	 *
	 * @param string $username
	 * @return bool
	 */
	public function usernameExists($username);



	/**
	 * Detect if mail exists
	 *
	 * @param string $email
	 * @return bool
	 */
	public function emailExists($email);



	/**
	 * Fetch user account entity by unique username
	 *
	 * @param string $username
	 * @return UserAccount
	 */
	public function findByUsername($username);



	/**
	 * Fetch user account entity by unique email
	 *
	 * @param string $email
	 * @return UserAccount
	 */
	public function findByEmail($email);

}

