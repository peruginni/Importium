<?php

namespace Om\Core;

use Nette\Environment;
use Nette\Caching\ICacheStorage;
use Om\Utilities\IPaginator;

/**
 * General class for business objects.
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
abstract class BaseBusiness implements IBaseBusiness
{
	
	/**
	 *
	 *  Implementation of IBaseBusiness
	 *
	 */



	/**
	 * Return DAO object from Nette service repository
	 *
	 * @return IBaseDao
	 */
	public function getDao($daoServiceIdentifier)
	{
		return Environment::getService($daoServiceIdentifier);
	}



	/**
	 * Persists given entity.
	 */
	public function persist($entity)
	{
		$this->getDefaultDao()->persist($entity);
	}



	/**
	 * Removes given entity
	 */
	public function remove($entity)
	{
		$this->getDefaultDao()->remove($entity);
	}



	/**
	 * Find entity by id
	 */
	public function findById($id)
	{
		return $this->getDefaultDao()->findById($id);
	}



	/**
	 * Find all entities. Can be limited by paginator
	 */
	public function findAll(IPaginator $paginator = null)
	{
		return $this->getDefaultDao()->findAll($paginator);
	}
	
}

