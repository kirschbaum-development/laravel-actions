<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\AfterEvent;
use Tests\Fixtures\Events\BeforeEvent;

class ActionWithAllEvents implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch before action starts.
     */
    public string $before = BeforeEvent::class;

    /**
     * Event to dispatch after action completes.
     */
    public string $after = AfterEvent::class;

    /**
     * Execute the action.
     */
    public function __invoke(): bool
    {
        return true;
    }
}
