<?php

namespace Om\Multimedia;

use Om\Core\BaseBusiness;
use Om\Utilities\IPaginator;

/**
 * Business class for folders
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class FolderBusiness extends BaseBusiness implements IFolderBusiness
{

	/** @var IFolderDao */
	protected $folderDao;


	/**
	 * Create new instance and initialize required daos
	 */
	public function  __construct()
	{
		// initialize daos
		$this->folderDao = $this->getDao('Om\Multimedia\IFolderDao');
	}



	/**
	 *
	 *  Implementation of IBaseBusiness
	 *
	 */



	/**
	 * Return default DAO object
	 */
	public function getDefaultDao()
	{
		return $this->folderDao;
	}



	/**
	 *
	 *  Implementation of IUserAccountBusiness
	 *
	 */

	 // empty
    
}

