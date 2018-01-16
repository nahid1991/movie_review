<?php

namespace App\Repositories\Traits;


trait RawQueryBuilderOutputTrait
{
    protected $outputRaw = false;

    public function setEnableRawOutput($e) {
        $this->outputRaw = $e;
        return $this->outputRaw;
    }

    public function getRawOutputEnabled()
    {
        return $this->outputRaw;
    }
}