<?php

namespace Tests\Fixtures\Actions;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Kirschbaum\Actions\Contracts\Actionable;

class ActionWithNoEvents implements Actionable
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
        return true;
    }
}
