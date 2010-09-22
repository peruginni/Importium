<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;
use Doctrine\ORM\QueryBuilder;

/**
 * FileDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FileDao extends BaseDao implements IFileDao
{
    protected $entityName = 'CMS\Multimedia\File';

    protected $orderByColumns = array(
        IFileDao::DATE_CREATED,
        IFileDao::TITLE
    );

    /** @return \Doctrine\ORM\Query */
    public function findByFolder(Folder $folder, array $orderBy = array())
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('u');
        $qb->from($this->entityName, 'u');
        $qb->where('u.folder = ?1');
        $qb->setParameter(1, $folder);
        $this->configureOrderBy($qb, $orderBy);
        return $qb->getQuery();
    }

    /** @return ArrayCollection */
    public function findByTitle($title)
    {
        return $this->em->getRepository($this->entityName)->findByTitle($title);
    }
}

