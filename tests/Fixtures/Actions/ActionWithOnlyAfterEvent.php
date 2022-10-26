<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\AfterEvent;
use Throwable;

class ActionWithOnlyAfterEvent implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch after action completes.
     *
     * @var string
     */
    public $after = AfterEvent::class;

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
