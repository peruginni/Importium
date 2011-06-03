<?php

namespace Om\Core;

use Om\Utilities\IPaginator;

/**
 * IBaseBusiness
 *
 * General interface for business objects.
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IBaseBusiness 
{
	
	/**
	 * Return object from Nette service repository
	 */
	public function inject($serviceId);



	/**
	 * Return default DAO object
	 */
	public function getDefaultDao();
	


	/**
	 * Persists given entity.
	 */
	public function persist($entity);



	/**
	 * Removes given entity
	 */
	public function remove($entity);



	/**
	 * Find entity by id
	 */
	public function findById($id);



	/**
	 * Find all entities. Can be limited by paginator
	 */
	public function findAll(IPaginator $paginator = null);


}

