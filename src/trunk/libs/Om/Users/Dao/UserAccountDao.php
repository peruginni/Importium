<?php

namespace Om\Users;

use Om\Core\BaseDao;

/**
 * DAO for user accounts
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class UserAccountDao extends BaseDao implements IUserAccountDao
{

	/**
	 *
	 *  Implementation of BaseDao
	 *
	 */


	
	/**
	 * Get fully canonized entity name (with namespace)
	 *
	 * @return string
	 */
	public function getEntityName()
	{
		return 'Om\Users\UserAccount';
	}


	/**
	 *
	 *  Implementation of IUserAccountDao
	 *
	 */



	/**
	 * Detect if username exists
	 *
	 * @param string $username
	 * @return bool
	 */
	public function usernameExists($username)
	{
		$query = $this->em->createQuery('
			SELECT COUNT(e.id) FROM '.$this->getEntityName().' e
			WHERE e.username = ?1'
		)->setParameter(1, $username);
		
		return (bool) $query->getSingleScalarResult();
	}



	/**
	 * Detect if mail exists
	 * 
	 * @param string $email
	 * @return bool
	 */
	public function emailExists($email)
	{
		$query = $this->em->createQuery('
			SELECT COUNT(e.id) FROM '.$this->getEntityName().' e
			WHERE e.email = ?1'
		)->setParameter(1, $email);

		return (bool) $query->getSingleScalarResult();
	}



	/**
	 * Fetch user account entity by unique username
	 *
	 * @param string $username
	 * @return UserAccount
	 */
	public function findByUsername($username)
	{
		return $this->em->getRepository($this->getEntityName())
			    ->findOneByUsername($username);
	}



	/**
	 * Fetch user account entity by unique email
	 *
	 * @param string $email
	 * @return UserAccount
	 */
	public function findByEmail($email)
	{
		return $this->em->getRepository($this->getEntityName())
				->findOneByEmail($email);
	}

}

