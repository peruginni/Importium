<?php

namespace CMS\Security;

use CMS\Common\BaseBusiness;

/**
 * RoleBusiness
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class RoleBusiness extends BaseBusiness implements IRoleBusiness
{
    protected $daoType = 'CMS\Security\IRoleDao';

    /** @var IRoleDao */
    protected $dao;

    /** @return Role */
    public function findByName($name)
    {
        switch($name) {
            case self::ADMIN:
            case self::EDITOR:
            case self::GUEST:
                break;
            default:
                throw new InvalidArgumentException();
        }

        return $this->dao->findByName($name);
    }

}

