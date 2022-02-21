<?php

namespace Tests\Fixtures;

class CallHelperMethods
{
    public function runActTest()
    {
        act(new ActionWithAllEvents());
    }

    public function runActWhenTest(bool $condition)
    {
        act_when($condition, new ActionWithAllEvents());
    }

    public function runActUnlessTest(bool $condition)
    {
        act_unless($condition, new ActionWithAllEvents());
    }
}
