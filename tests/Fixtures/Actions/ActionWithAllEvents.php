<?php

namespace Tests\Fixtures\Actions;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\AfterEvent;
use Tests\Fixtures\Events\BeforeEvent;
use Kirschbaum\Actions\Contracts\Actionable;

class ActionWithAllEvents implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch before action starts.
     *
     * @var string
     */
    public $before = BeforeEvent::class;

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
