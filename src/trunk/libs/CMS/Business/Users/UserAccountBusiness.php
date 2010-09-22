<?php

namespace CMS\Users;

use Nette\Security\IAuthenticator;
use Nette\Security\AuthenticationException;
use Nette\Security\Identity;
use CMS\InvalidArgumentException;
use CMS\Email;
use CMS\Text;
use DateTime;

/**
 * UserAccountBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class UserAccountBusiness extends BaseBusiness implements IUserAccountBusiness, IAuthenticator
{
    protected $daoType = 'CMS\Users\IUserAccountDao';

    /** @var IUserAccountDao */
    protected $dao;

    public function usernameExists($username)
    {
        return $this->dao->usernameExists($username);
    }

    public function emailExists($email)
    {
        return $this->dao->emailExists($email);
    }

    public function signUp(UserAccount $userAccount)
    {
        if($this->usernameExists($userAccount->getUsername()))
            throw new InvalidArgumentException('Username exists', self::USERNAME_EXISTS);
        if($this->emailExists($userAccount->getEmail()))
            throw new InvalidArgumentException('Email exists', self::EMAIL_EXISTS);

        if(empty($userAccount->getSalt()))
            $this->securePassword($userAccount);

        $userAccount->setDateCreated(new DateTime());

        $this->dao->persist($userAccount);
    }

    public function persist(UserAccount $userAccount)
    {
        $currentAccount = $this->dao->findById($userAccount->getId());
        if($userAccount->getUsername() !== $currentAccount->getUsername()) {
            if($this->usernameExists($userAccount->getUsername()))
                throw new InvalidArgumentException('Username exists', self::USERNAME_EXISTS);
        }
        if($userAccount->getEmail() !== $currentAccount->getEmail()) {
            if($this->emailExists($userAccount->getEmail()))
                throw new InvalidArgumentException('Email exists', self::EMAIL_EXISTS);
        }

        if(empty($userAccount->getSalt()))
            $this->securePassword($userAccount);

        $this->dao->persist($userAccount);
    }

    public function authenticate(array $credentials)
    {
        $username = $credentials[self::USERNAME];
        $password = $credentials[self::PASSWORD];

        $userAccount = null;
        if(Email::isValidFormat($username)) {
            $userAccount = $this->dao->findByEmail($username);
        } else {
            $userAccount = $this->dao->findByUsername($username);
        }

        if(!$userAccount) {
            throw new AuthenticationException('User '.$username.' not found', self::IDENTITY_NOT_FOUND);
        }

        if($userAccount->getPassword() !== md5($password.$userAccount->getSalt())) {
            throw new AuthenticationException('Invalid password', self::INVALID_CREDENTIAL);
        }

        $userAccount->setPassword(null);

        return new Identity(
            $userAccount->getId(),
            $userAccount->getRoles(),
            array(
                'username' => $userAccount->getUsername(),
                'realName' => $userAccount->getRealName(),
                'email' => $userAccount->getEmail()
            )
        );
    }

    protected function createSalt()
    {
        return Text::random(Text::ALPHANUMERIC, 30);
    }

    protected function securePassword(UserAccount &$userAccount)
    {
        $userAccount->setSalt($this->createSalt());

        $password = $userAccount->getPassword();
        $password = md5($password.$userAccount->getSalt());
        $userAccount->setPassword($password);
    }
}

