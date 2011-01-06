<?php

namespace Om\Utilities;

/**
 * Holds information about paginating for certain query
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPaginator
{

	/**
	 *
	 *  Getters and setters
	 *
	 */



	/**
	 * Get/set current page
	 */
	public function getCurrentPage();

	public function setCurrentPage($currentPage);



	/**
	 * Get/set results per page
	 */
	public function getResultsPerPage();

	public function setResultsPerPage($resultsPerPage);



	/**
	 * Get/set total number of results
	 */
	public function getTotalResults();

	public function setTotalResults($totalResults);



	/**
	 * Returns true if current page has precending page. False if not.
	 *
	 * @return boolean
	 */
	public function hasPrevious();



	/**
	 * Returns true if current page has next page. False if not.
	 *
	 * @return boolean
	 */
	public function hasNext();


	/**
	 * Get next/previous
	 */
	public function getNext();
	public function getPrevious();
}

