<?php

namespace Tests\Fixtures;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;

class ActionWithoutInterface
{
    use CanAct;

    /**
     * Execute the action.
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public function __invoke()
    {
        // We will never get here.
    }
}
