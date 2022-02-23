<?php

namespace Tests\Fixtures;

use Tests\Fixtures\Actions\ActionWithAllEvents;

class CallHelperMethods
{
    public function runActTest()
    {
        act(ActionWithAllEvents::class);
    }

    public function runActWhenTest(bool $condition)
    {
        act_when($condition, ActionWithAllEvents::class);
    }

    public function runActUnlessTest(bool $condition)
    {
        act_unless($condition, ActionWithAllEvents::class);
    }
}
