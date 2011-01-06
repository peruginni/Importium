<?php

namespace Om\Multimedia;

use Om\Core\BaseDao;
use Om\Utilities\IPaginator;


/**
 * Dao for albums
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class AlbumDao extends BaseDao implements IAlbumDao
{

	/**
	 *
	 *  Implementation of BaseDao
	 *
	 */



	/**
	 * Get fully canonized entity name (with namespace)
	 *
	 * @return string
	 */
	public function getEntityName()
	{
		return 'Om\Multimedia\Album';
	}



	/**
	 *
	 *  Implementation of IAlbumDao
	 *
	 */



	/**
	 * Find all album. Can be limited by paginator.
	 *
	 * @return ArrayCollection
	 */
	public function findAll(IPaginator $paginator = null)
	{
		$qb = $this->createQueryBuilder();
		
		$qb->orderBy('e.dateCreated', 'DESC');

		if($paginator !== null) {
			$this->setupPaginator($qb, $paginator);
		}

		return $qb->getQuery()->getResult();
	}

}

