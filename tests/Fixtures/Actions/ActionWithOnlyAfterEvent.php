<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\AfterEvent;

class ActionWithOnlyAfterEvent implements Actionable
{
    use CanAct;

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
