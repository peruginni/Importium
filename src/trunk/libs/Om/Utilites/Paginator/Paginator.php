<?php

namespace Om\Utilities;

use Om\InvalidStateException;

/**
 * Holds information about paginating for certain query
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class Paginator implements IPaginator
{

	/**
	 * Number of current page
	 *
	 * @var int
	 */
	protected $currentPage;

	/**
	 * How many results per page to display
	 *
	 * @var int
	 */
	protected $resultsPerPage;

	/**
	 * Total number of results for query
	 * @var int
	 */
	protected $totalResults;



	public function  __construct()
	{
		$this->resultsPerPage = 15;
		$this->currentPage = 1;
	}



	/**
	 *
	 *  Getters and setters
	 *
	 */



	/**
	 * Get/set current page
	 */
	public function getCurrentPage()
	{
		if($this->currentPage === null) {
			throw new InvalidStateException('Current page not yet set');
		}
		
		return (int) $this->currentPage;
	}

	public function setCurrentPage($currentPage)
	{
		$this->currentPage = (int) $currentPage;
	}



	/**
	 * Get/set results per page
	 */
	public function getResultsPerPage()
	{
		return (int) $this->resultsPerPage;
	}

	public function setResultsPerPage($resultsPerPage)
	{
		$this->resultsPerPage = (int) $resultsPerPage;
	}



	/**
	 * Get/set total number of results
	 */
	public function getTotalResults()
	{
		if($this->totalResults === null) {
			throw new InvalidStateException('Total results not yet computed');
		}

		return (int) $this->totalResults;
	}

	public function setTotalResults($totalResults)
	{
		$this->totalResults = (int) $totalResults;
	}



	/**
	 * Returns true if current page has precending page. False if not.
	 *
	 * @return boolean
	 */
	public function hasPrevious()
	{
		return ($this->getCurrentPage() > 1) ? true : false;
	}



	/**
	 * Returns true if current page has next page. False if not.
	 *
	 * @return boolean
	 */
	public function hasNext()
	{
		$lastPage = ceil($this->getTotalResults() / $this->getResultsPerPage());

		return ($this->getCurrentPage() < $lastPage) ? true : false;
	}



	/**
	 * Get next/previous
	 */
	public function getNext()
	{
		return ($this->hasNext()) ? $this->currentPage + 1 : null;
	}



	public function getPrevious()
	{
		return ($this->hasPrevious()) ? $this->currentPage - 1 : null;
	}
	
}
