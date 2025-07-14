<?php

namespace Tests\Fixtures\Actions;

use Kirschbaum\Actions\Traits\CanAct;

class ActionWithoutInterface
{
    use CanAct;

    /**
     * Execute the action.
     */
    public function __invoke(): void
    {
        // We will never get here.
    }
}
