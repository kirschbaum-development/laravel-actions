<?php

namespace Tests\Fixtures;

use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class CallFacadeMethods
{
    public function runActTest()
    {
        Action::act(ActionWithAllEvents::class);
    }

    public function runActWhenTest(bool $condition)
    {
        Action::actWhen($condition, ActionWithAllEvents::class);
    }

    public function runActUnlessTest(bool $condition)
    {
        Action::actUnless($condition, ActionWithAllEvents::class);
    }
}
