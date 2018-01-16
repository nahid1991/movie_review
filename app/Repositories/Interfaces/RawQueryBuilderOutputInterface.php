<?php

namespace App\Repositories\Interfaces;


interface RawQueryBuilderOutputInterface
{
    public function setEnableRawOutput($e);

    public function getRawOutputEnabled();

}