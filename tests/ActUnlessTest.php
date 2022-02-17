<?php

namespace Tests;

use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\ActionWithAllEvents;

class ActUnlessTest extends TestCase
{
    public function testActUnlessFromCanActTraitRunsIfFalsy()
    {
        // Act.
        $response = ActionWithAllEvents::actUnless(false);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessFromCanActTraitRejectsIfTruthy()
    {
        // Act.
        $response = ActionWithAllEvents::actUnless(true);

        // Assert.
        $this->assertNull($response);
    }

    public function testActUnlessFromFacadeRunsIfFalsy()
    {
        // Act.
        $response = Action::actUnless(false, new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessFromFacadeRejectsIfTruthy()
    {
        // Act.
        $response = Action::actUnless(true, new ActionWithAllEvents());

        // Assert.
        $this->assertNull($response);
    }
}
