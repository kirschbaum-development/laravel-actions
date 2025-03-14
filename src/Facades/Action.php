<?php

namespace Kirschbaum\Actions\Facades;

use Illuminate\Support\Facades\Facade;

class Action extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'actions';
    }
}
