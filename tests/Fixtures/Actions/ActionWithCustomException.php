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
     *
     * @var string
     */
    public $exception = CustomFailedException::class;

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
