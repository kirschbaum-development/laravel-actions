<?php

namespace Tests\Fixtures\Actions;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Kirschbaum\Actions\Contracts\Actionable;
use Tests\Fixtures\Exceptions\CustomFailedException;
use Kirschbaum\Actions\Exceptions\ActionFailedException;

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
     * @throws Throwable
     *
     * @return mixed
     */
    public function __invoke()
    {
        throw new ActionFailedException();
    }
}
