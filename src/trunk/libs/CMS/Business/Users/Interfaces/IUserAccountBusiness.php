<?php

namespace CMS\Users;

/**
 * IUserAccountBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IUserAccountBusiness extends \CMS\Common\IBaseBusiness
{
    const USERNAME_EXISTS = 10;
    const EMAIL_EXISTS = 11;

    public function usernameExists($username);
    public function emailExists($email);
    public function signUp(UserAccount $userAccount);
    //public function authorizeEmail();
}

