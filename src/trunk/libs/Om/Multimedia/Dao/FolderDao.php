<?php

namespace Om\Multimedia;

use Om\Core\BaseDao;
use Om\Utilities\IPaginator;

/**
 * DAO for folders
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FolderDao extends BaseDao implements IFolderDao
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
		return 'Om\Multimedia\Folder';
	}

	

	/**
	 *
	 *  Implementation of IFolderDao
	 *
	 */



	/**
	 * Find all folders. Can be limited by paginator.
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

