<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PaginatedResultInterface;
use App\Repositories\Interfaces\RawQueryBuilderOutputInterface;
use App\Repositories\Traits\PaginatedOutputTrait;
use App\Repositories\Traits\ProcessOutputTrait;
use App\Repositories\Traits\RawQueryBuilderOutputTrait;

class MoviesRepository implements PaginatedResultInterface, RawQueryBuilderOutputInterface {
    use PaginatedOutputTrait, ProcessOutputTrait, RawQueryBuilderOutputTrait;
}

