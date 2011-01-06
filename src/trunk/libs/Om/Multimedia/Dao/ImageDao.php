<?php

namespace Om\Multimedia;

use Om\Core\BaseDao;
use Om\Utilities\IPaginator;

/**
 * Dao for images
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class ImageDao extends BaseDao implements IImageDao
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
		return 'Om\Multimedia\Image';
	}



	/**
	 *
	 *  Implementation of IImageDao
	 *
	 */



	/**
	 * Find all files under given folder
	 *
	 * @return ArrayCollection
	 */
	public function findImagesByAlbum(Album $album, IPaginator $paginator = null)
	{
		$qb = $this->createQueryBuilder();
		$albumId = $album->getId();

		if(!$albumId) {
			throw new InvalidArgumentException();
		}

		$qb->where('e.album = :album');
		$qb->setParameter(':album', $albumId);

		$qb->orderBy('e.ordering', 'ASC');

		if($paginator !== null) {
			$this->setupPaginator($qb, $paginator);
		}

		return $qb->getQuery()->getResult();
	}

}

