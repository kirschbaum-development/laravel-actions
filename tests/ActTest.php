<?php

namespace Tests;

use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\ActionWithAllEvents;

class ActTest extends TestCase
{
    public function testActFromCanActTrait()
    {
        // Act.
        $response = ActionWithAllEvents::act();

        // Assert.
        $this->assertTrue($response);
    }

    public function testActFromFacade()
    {
        // Act.
        $response = Action::act(new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }
}
