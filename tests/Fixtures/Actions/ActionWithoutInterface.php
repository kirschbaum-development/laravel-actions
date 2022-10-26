<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Traits\CanAct;
use Throwable;

class ActionWithoutInterface
{
    use CanAct;

    /**
     * Execute the action.
     *
     * @return mixed
     *
     * @throws Throwable
     */
    public function __invoke()
    {
        // We will never get here.
    }
}
