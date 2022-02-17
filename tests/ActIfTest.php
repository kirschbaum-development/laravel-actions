<?php

namespace Tests;

use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\ActionWithAllEvents;

class ActIfTest extends TestCase
{
    public function testActIfFromCanActTraitRunsIfTruthy()
    {
        // Act.
        $response = ActionWithAllEvents::actIf(true);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActIfFromCanActTraitRejectsIfFalsy()
    {
        // Act.
        $response = ActionWithAllEvents::actIf(false);

        // Assert.
        $this->assertNull($response);
    }

    public function testActIfFromFacadeRunsIfTruthy()
    {
        // Act.
        $response = Action::actIf(true, new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }

    public function testActIfFromFacadeRejectsIfFalsy()
    {
        // Act.
        $response = Action::actIf(false, new ActionWithAllEvents());

        // Assert.
        $this->assertNull($response);
    }
}
