<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\ActionWithAllEvents;

class ActUnlessTest extends TestCase
{
    public function testActUnlessRunsIfFalsy()
    {
        // Act.
        $response = actUnless(false, new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessRejectsIfTruthy()
    {
        // Act.
        $response = actUnless(true, new ActionWithAllEvents());

        // Assert.
        $this->assertNull($response);
    }
}
