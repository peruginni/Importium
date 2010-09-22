<?php

namespace CMS\Users;

use CMS\Common\BaseDao;

/**
 * UserAccountDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class UserAccountDao extends BaseDao implements IUserAccountDao
{
    protected $entityName = 'CMS\Users\UserAccount';

    public function usernameExists($username)
    {
        $query = $this->em->createQuery('
            SELECT COUNT(u.id) FROM '.$this->entityName.' u
            WHERE u.username = ?1'
        )->setParameter(1, $username);
        return (bool) $query->getSingleScalarResult();
    }

    public function emailExists($email)
    {
        $query = $this->em->createQuery('
            SELECT COUNT(u.id) FROM '.$this->entityName.' u
            WHERE u.email = ?1'
        )->setParameter(1, $email);
        return (bool) $query->getSingleScalarResult();
    }

    public function findByUsername($username)
    {
        return $this->em->getRepository($this->entityName)->findOneByUsername($username);
    }

    public function findByEmail($email)
    {
        return $this->em->getRepository($this->entityName)->findOneByEmail($email);
    }

    public function findByRealName($realName)
    {
        return $this->em->getRepository($this->entityName)->findByRealName($realName);
    }
}

