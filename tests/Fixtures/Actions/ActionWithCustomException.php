<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Exceptions\ActionFailedException;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Exceptions\CustomFailedException;
use Throwable;

class ActionWithCustomException implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch if action throws an exception.
     */
    public string $exception = CustomFailedException::class;

    /**
     * Execute the action.
     *
     * @throws Throwable
     */
    public function __invoke()
    {
        throw new ActionFailedException();
    }
}
