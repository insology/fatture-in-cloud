<?php

namespace InsologyStudio\FattureInCloud\Facades;

use Illuminate\Support\Facades\Facade;

class FattureInCloud extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'fatture-in-cloud';
    }
}
