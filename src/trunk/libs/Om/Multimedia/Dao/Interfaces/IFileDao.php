<?php

namespace Om\Multimedia;

use Om\Core\IBaseDao;
use Om\Utilities\IPaginator;

/**
 * Interface of DAO for files
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IFileDao extends IBaseDao
{

	/**
	 * Find all files under given folder
	 *
	 * @return ArrayCollection
	 */
	public function findFilesByFolder(Folder $folder, IPaginator $paginator = null);

}

