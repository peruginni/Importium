<?php

namespace Om\Users;

use Nette\Security\IAuthenticator;
use Nette\Security\AuthenticationException;
use Nette\Security\Identity;
use Om\Core\BaseBusiness;
use Om\InvalidArgumentException;
use Om\Email;
use Om\Text;
use DateTime;

/**
 * UserAccountBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class UserAccountBusiness extends BaseBusiness implements IUserAccountBusiness, IAuthenticator
{
	
	/** @var IUserAccountDao */
	protected $userAccountDao;


	/**
	 * Create new instance and initialize required daos
	 */
	public function  __construct()
	{
		// initialize daos
		$this->userAccountDao = $this->inject('Om\Users\IUserAccountDao');
	}



	/**
	 *
	 *  Implementation of IBaseBusiness
	 *
	 */



	/**
	 * Return default DAO object
	 */
	public function getDefaultDao()
	{
		return $this->userAccountDao;
	}



	/**
	 *
	 *  Implementation of IUserAccountBusiness
	 *
	 */



	/**
	 * Detect if user account with given username exists
	 *
	 * @param string $username
	 * @return bool
	 */
	public function usernameExists($username)
	{
		return $this->getDefaultDao()->usernameExists($username);
	}



	/**
	 * Detect if user account with given email exists
	 * 
	 * @param string $email
	 * @return bool
	 */
	public function emailExists($email)
	{
		return $this->getDefaultDao()->emailExists($email);
	}



	/**
	 * Sign up new user account
	 * 
	 * @param UserAccount $userAccount
	 */
	public function signUp(UserAccount $userAccount)
	{
		if($this->getDefaultDao()->usernameExists($userAccount->getUsername())) {
			throw new InvalidArgumentException('Username exists', self::USERNAME_EXISTS);
		}
		    
		if($this->getDefaultDao()->emailExists($userAccount->getEmail())) {
			throw new InvalidArgumentException('Email exists', self::EMAIL_EXISTS);
		}

		$this->securePassword($userAccount);
			
		$userAccount->setDateCreated(new DateTime());

		$this->getDefaultDao()->persist($userAccount);
	}



	/**
	 * Save changes for existing account. Will check if username and email
	 * were not changed.
	 *
	 * @param UserAccount $userAccount
	 */
	public function saveChanges(UserAccount $changedEntity)
	{
		$currentEntity = $this->getDefaultDao()->findById($changedEntity->getId());
		
		if($changedEntity->getUsername() !== $currentEntity->getUsername()) {
			if($this->usernameExists($changedEntity->getUsername()))
				throw new InvalidArgumentException('Username exists', self::USERNAME_EXISTS);
		}
		
		if($changedEntity->getEmail() !== $currentEntity->getEmail()) {
			if($this->emailExists($changedEntity->getEmail()))
				throw new InvalidArgumentException('Email exists', self::EMAIL_EXISTS);
		}

		$this->getDefaultDao()->persist($changedEntity);
	}



	/**
	 * Change password for given user account
	 *
	 * @param UserAccount $userAccount
	 * @param string $newPassword
	 */
	public function changePassword(UserAccount $userAccount, $newPassword)
	{
		$userAccount->setPassword($newPassword);
		$this->securePassword($userAccount);
		
		$this->getDefaultDao()->persist($userAccount);
	}

	

	/**
	 *
	 *  Implementation of IAuthenticator
	 *
	 */

	

	/**
	 * Authenticate username and password and return Nette Identity
	 * @param array $credentials
	 * @return Identity
	 */
	public function authenticate(array $credentials)
	{
		$username = $credentials[self::USERNAME];
		$password = $credentials[self::PASSWORD];

		$userAccount = null;
		if(Email::isValidFormat($username)) {
			$userAccount = $this->getDefaultDao()->findByEmail($username);
		} else {
			$userAccount = $this->getDefaultDao()->findByUsername($username);
		}

		if(!$userAccount) {
			throw new AuthenticationException(
				'User '.$username.' not found',
				self::IDENTITY_NOT_FOUND
			);
		}

		if($userAccount->getPassword() !== md5($password.$userAccount->getSalt())) {
			throw new AuthenticationException(
				'Invalid password',
				self::INVALID_CREDENTIAL
			);
		}

		$userAccount->setSalt(null);
		$userAccount->setPassword(null);

		return new Identity(
			$userAccount->getId(),
			null,
			array(
				'username' => $userAccount->getUsername(),
				'realName' => $userAccount->getRealName(),
				'email' => $userAccount->getEmail()
			)
		);
	}



	/**
	 *
	 *  Helpers
	 *
	 */



	/**
	 * Create salt string
	 *
	 * @return string
	 */
	protected function createSalt()
	{
		return Text::random(Text::ALPHANUMERIC, 30);
	}



	/**
	 * Mix password with new salt and hash it with md5
	 * 
	 * @param UserAccount $userAccount
	 */
	protected function securePassword(UserAccount $userAccount)
	{
		$userAccount->setSalt($this->createSalt());

		$password = $userAccount->getPassword();
		$password = md5($password.$userAccount->getSalt());
		$userAccount->setPassword($password);
	}
	
}

