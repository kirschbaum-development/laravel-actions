<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;
use Throwable;

class ActionWithNoEvents implements Actionable
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
        return true;
    }
}
