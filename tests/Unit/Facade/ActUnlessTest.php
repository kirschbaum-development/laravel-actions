<?php

namespace Tests\Unit\Facade;

use Tests\TestCase;
use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithAllEvents;

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
