<?php

namespace Om\Multimedia;

use Om\Core\BaseDao;
use Om\InvalidArgumentException;
use Om\Utilities\IPaginator;


/**
 * DAO for files
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FileDao extends BaseDao implements IFileDao
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
		return 'Om\Multimedia\File';
	}

	

	/**
	 *
	 *  Implementation of IFileDao
	 *
	 */



	/**
	 * Find all files under given folder
	 *
	 * @return ArrayCollection
	 */
	public function findFilesByFolder(Folder $folder, IPaginator $paginator = null)
	{
		$qb = $this->createQueryBuilder();
		$folderId = $folder->getId();

		if(!$folderId) {
			throw new InvalidArgumentException();
		}

		$qb->where('e.folder = :folder');
		$qb->setParameter('folder', $folderId);

		$qb->orderBy('e.dateCreated', 'DESC');

		if($paginator !== null) {
			$this->setupPaginator($qb, $paginator);
		}

		return $qb->getQuery()->getResult();
	}

}

