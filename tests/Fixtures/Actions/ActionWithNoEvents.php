<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Traits\CanAct;

class ActionWithNoEvents implements Actionable
{
    use CanAct;

    /**
     * Execute the action.
     */
    public function __invoke(): bool
    {
        return true;
    }
}
