<?php

namespace CMS\Multimedia;

use CMS\Common\BaseDao;

/**
 * ImageDao
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class ImageDao extends BaseDao implements IImageDao
{
    protected $entityName = 'CMS\Multimedia\Image';

    protected $orderByColumns = array(
        IImageDao::DATE_CREATED,
        IImageDao::ORDER
    );

    /** @return \Doctrine\ORM\Query */
    public function findAll(array $orderBy = array(), $includeThumbnails = false)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('u')->from($this->entityName, 'u');
        $this->configureOrderBy($qb, $orderBy);
        if($includeThumbnails == false) {
            $qb->where('u.sourceImage IS NULL');
        }
        return $qb->getQuery();
    }
}

