<?php

namespace Tests\Fixtures\Actions;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\AfterEvent;
use Kirschbaum\Actions\Contracts\Actionable;

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
     * @throws Throwable
     *
     * @return mixed
     */
    public function __invoke()
    {
        return true;
    }
}
