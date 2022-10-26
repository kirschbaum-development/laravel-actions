<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\BeforeEvent;
use Throwable;

class ActionWithOnlyBeforeEvent implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch before action starts.
     *
     * @var string
     */
    public $before = BeforeEvent::class;

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
