<?php

namespace App\Repositories\Traits;


use App\Repositories\Interfaces\PaginatedResultInterface;
use App\Repositories\Interfaces\RawQueryBuilderOutputInterface;

trait ProcessOutputTrait
{

    public function output($query)
    {
        if (($this instanceof RawQueryBuilderOutputInterface) && $this->getRawOutputEnabled()) {
            return $query;
        }
        else {
            if (($this instanceof PaginatedResultInterface) && $this->isEnablePagination()) {
                return $query->paginate($this->getResultsPerPage());
            }
            else {
                return $query->get();
            }
        }
    }
}