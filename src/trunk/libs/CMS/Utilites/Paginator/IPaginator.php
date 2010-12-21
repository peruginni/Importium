<?php

namespace CMS\Utilities;

/**
 * IPaginator
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IPaginator
{
    public function getCurrentPage();
    public function setCurrentPage($currentPage);
    public function getResultsPerPage();
    public function setResultsPerPage($resultsPerPage);
    public function getTotalResults();
    public function setTotalResults($totalResults);
    public function hasPrevious();
    public function hasNext();
}

