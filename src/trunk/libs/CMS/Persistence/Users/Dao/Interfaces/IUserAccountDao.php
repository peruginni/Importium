<?php

namespace CMS\Users;

/**
 * IUserAccountDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IUserAccountDao extends \CMS\Common\IBaseDao
{
    public function usernameExists($username);
    public function emailExists($email);
    public function findByUsername($username);
    public function findByEmail($email);
    public function findByRealName($realName);
}

