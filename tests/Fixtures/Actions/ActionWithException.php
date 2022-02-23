<?php

namespace Tests\Fixtures\Actions;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Exceptions\ActionFailedException;

class ActionWithException implements Actionable
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
        throw new ActionFailedException();
    }
}
