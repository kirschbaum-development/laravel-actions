<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Exceptions\ActionFailedException;
use Kirschbaum\Actions\Traits\CanAct;
use Throwable;

class ActionWithException implements Actionable
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
        throw new ActionFailedException();
    }
}
