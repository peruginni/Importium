<?php

namespace Om\Multimedia;

use Om\Core\IBaseDao;
use Om\Utilities\IPaginator;

/**
 * Interface of Dao for images
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IImageDao extends IBaseDao
{

	/**
	 * Find all files under given folder
	 *
	 * @return ArrayCollection
	 */
	public function findImagesByAlbum(Album $album, IPaginator $paginator = null);

}

