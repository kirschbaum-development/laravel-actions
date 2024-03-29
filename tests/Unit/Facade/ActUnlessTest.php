<?php

namespace Tests\Unit\Facade;

use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\TestCase;

class ActUnlessTest extends TestCase
{
    public function testActUnlessRunsIfFalsy()
    {
        // Act.
        $response = Action::actUnless(false, ActionWithAllEvents::class);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessRejectsIfTruthy()
    {
        // Act.
        $response = Action::actUnless(true, ActionWithAllEvents::class);

        // Assert.
        $this->assertNull($response);
    }
}
