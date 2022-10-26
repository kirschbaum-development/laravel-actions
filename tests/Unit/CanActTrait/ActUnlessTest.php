<?php

namespace Tests\Unit\CanActTrait;

use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\TestCase;

class ActUnlessTest extends TestCase
{
    public function testActUnlessRunsIfFalsy()
    {
        // Act.
        $response = ActionWithAllEvents::actUnless(false);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessRejectsIfTruthy()
    {
        // Act.
        $response = ActionWithAllEvents::actUnless(true);

        // Assert.
        $this->assertNull($response);
    }
}
