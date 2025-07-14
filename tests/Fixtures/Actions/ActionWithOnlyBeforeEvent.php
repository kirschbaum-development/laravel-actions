<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\BeforeEvent;

class ActionWithOnlyBeforeEvent implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch before action starts.
     */
    public string $before = BeforeEvent::class;

    /**
     * Execute the action.
     */
    public function __invoke(): bool
    {
        return true;
    }
}
