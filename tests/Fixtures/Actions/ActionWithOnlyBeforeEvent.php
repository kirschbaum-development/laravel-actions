<?php

namespace Tests\Fixtures\Actions;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\BeforeEvent;
use Kirschbaum\Actions\Contracts\Actionable;

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
     * @throws Throwable
     *
     * @return mixed
     */
    public function __invoke()
    {
        return true;
    }
}
