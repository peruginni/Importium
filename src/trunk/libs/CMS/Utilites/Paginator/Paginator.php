<?php

namespace CMS\Utilities;

use CMS\InvalidStateException;

/**
 * Paginator
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
class Paginator implements IPaginator
{
	protected $currentPage;
	protected $resultsPerPage = 15;
	protected $totalResults;



	/** @return int */
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



	/** @return int */
	public function getResultsPerPage()
	{
		return (int) $this->resultsPerPage;
	}



	public function setResultsPerPage($resultsPerPage)
	{
		$this->resultsPerPage = (int) $resultsPerPage;
	}



	/** @return int */
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



	public function hasPrevious()
	{
		return ($this->getCurrentPage() > 1) ? true : false;
	}



	public function hasNext()
	{
		$lastPage = ceil($this->getTotalResults() / $this->getResultsPerPage());

		return ($this->getCurrentPage() < $lastPage) ? true : false;
	}
}
