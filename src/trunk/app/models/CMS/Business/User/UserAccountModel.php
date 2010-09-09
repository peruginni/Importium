<?php

namespace CMS\User;

use CMS\Entity\User\UserAccount;
use Nette\Security\AuthenticationException;
use Text;


/**
 * UserAccountModel
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class UserAccountModel extends \CMS\BaseModel implements IUserAccountModel
{


    
    public function add(UserAccount $userAccount)
    {
        // generate salt
        $salt = $this->generateSalt();
        $userAccount->setSalt($salt);

        // encrypt password using salt
        $hashedPassword = $this->getPasswordHash($password, $salt);
        $userAccount->setPassword($hashedPassword);

        // check username uniqueness
        if($this->usernameExists($userAccount->getUsername())) {
            throw new InvalidStateException("Username already exists", self::ERROR_USERNAME_EXISTS);
        }

        // check email uniqueness
        if($this->emailExists($userAccount->getEmail())) {
            throw new InvalidStateException("E-mail already exists", self::ERROR_EMAIL_EXISTS);
        }

        $this->em->persist($userAccount);
        $this->em->flush();
    }



    public function changePassword(UserAccount $userAccount, $newPassword)
    {
        //$userAccount = $this->get($userAccount);

        // generate salt
        $salt = $this->generateSalt();
        $userAccount->setSalt($salt);

        // encrypt password using salt
        $hashedPassword = $this->getPasswordHash($password, $salt);
        $userAccount->setPassword($hashedPassword);

        $this->em->persist($userAccount);
    }



    public function delete(UserAccount $userAccount)
    {
        $this->em->remove($userAccount);
        $this->em->flush();
    }



    public function edit(UserAccount $userAccount)
    {
        $this->em->persist($userAccount);
        $this->em->flush();
    }

    

    public function emailExists($email)
    {
        $query = $this->em->createQuery('SELECT COUNT(u.id) FROM UserAccount u WHERE u.email = :email');
        $query->setParameter('email', $email);
        return (bool) $query->getSingleResult();
    }


    
    public function get(UserAccount $userAccount)
    {
        $userAccount = $this->em->getRepository('UserAccount')->findOneById($userAccount->getId());

        if($userAccount != null) {
            $userAccount->setPassword(null);
            $userAccount->setSalt(null);
        }

        $this->em->detach($userAccount);
        return $userAccount;
    }


    /**
     * Get all user accounts
     * @return array
     */
    public function getAll()
    {
        $query = $this->em->createQuery('SELECT u, r FROM UserAccount u JOIN u.roles r');
        return $query->getResult();
    }

    /**
     * Get users with given role
     * @param Role $role
     * @return array
     */
    public function getByRole(Role $role)
    {
        $query = $this->em->createQuery('SELECT u, r FROM UserAccount u JOIN u.roles r WHERE r.id = :roleId');
        $query->setParameter('roleId', $role->getId());
        return $query->getResult();
    }
    

    /**
     * Get entity from database by username and password
     * @param string $username
     * @param string $password
     * @return UserAccount
     */
    public function getByCredentials($username, $password)
    {
        $userAccount = $this->em->getRepository('UserAccount')->findOneByUsername($username);

        if(!$userAccount) {
            return null;
        }

        $inputPasswordHash = $this->getPasswordHash($password, $userAccount->getSalt());

        if ($userAccount->getPassword() != $inputPasswordHash) {
            return null;
        }

        $this->em->detach($userAccount);

        $userAccount->setPassword(null);
        $userAccount->setSalt(null);

        return $userAccount;
    }



    public function usernameExists($username)
    {
        $query = $this->em->createQuery('SELECT COUNT(u.id) FROM UserAccount u WHERE u.username = :username');
        $query->setParameter('username', $username);
        return (bool) $query->getSingleResult();
    }

    

    /**
	 * Performs an authentication
	 * @param  array
	 * @return IIdentity
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		$username = $credentials[self::USERNAME];
		$password = $credentials[self::PASSWORD];

        $userAccount = $this->getByCredentials($username, $password);
        if(!$userAccount) {
            throw new AuthenticationException("Invalid credentials.", self::INVALID_CREDENTIAL);
        }

        $roles = $userAccount->getRoles();

        $rolesArray = array();
        foreach ($roles as $role) {
            $rolesArray[] = $role->getName();
        }

        $identity = new \Nette\Security\Identity($userAccount->getId(), $rolesArray);

        $identity['realName'] = $userAccount->getRealName();
        $identity['email'] = $userAccount->getEmail();

        return $identity;
	}



    protected function generateSalt()
    {
        return Text::random(Text::ALPHANUMERIC, 13);
    }


    
    protected function getPasswordHash($password, $salt)
    {
        return sha1($password.$salt);
    }

}


