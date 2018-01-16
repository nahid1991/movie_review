<?php

namespace App\Repositories\Interfaces;


interface PaginatedResultInterface
{
    /**
     * @return int
     */
    public function getResultsPerPage();

    /**
     * @param int $resultsPerPage
     * @return PaginatedResultInterface
     */
    public function setResultsPerPage($resultsPerPage);

    /**
     * @return boolean
     */
    public function isEnablePagination();

    /**
     * @param boolean $enablePagination
     * @return PaginatedResultInterface
     */
    public function setEnablePagination($enablePagination);

}