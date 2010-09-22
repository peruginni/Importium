<?php

namespace CMS\Redaction;

use CMS\Common\BaseDao;

/**
 * MenuDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class MenuDao extends BaseDao implements IMenuDao
{
    protected $entityName = 'CMS\Redaction\Menu';

    protected $orderByColumns = array(
        IMenuDao::NAME
    );

    /** @return Menu */
    public function findByName($name)
    {
        return $this->em->getRepository($this->entityName)->findOneByName($name);
    }
}

