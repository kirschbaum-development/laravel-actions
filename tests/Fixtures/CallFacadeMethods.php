<?php

namespace Tests\Fixtures;

use Kirschbaum\Actions\Facades\Action;

class CallFacadeMethods
{
    public function runActTest()
    {
        Action::act(new ActionWithAllEvents());
    }

    public function runActWhenTest(bool $condition)
    {
        Action::actWhen($condition, new ActionWithAllEvents());
    }

    public function runActUnlessTest(bool $condition)
    {
        Action::actUnless($condition, new ActionWithAllEvents());
    }
}
