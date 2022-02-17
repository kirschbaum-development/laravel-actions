<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\ActionWithAllEvents;

class ActUnlessTest extends TestCase
{
    public function testActUnlessRunsIfFalsy()
    {
        // Act.
        $response = act_unless(false, new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessRejectsIfTruthy()
    {
        // Act.
        $response = act_unless(true, new ActionWithAllEvents());

        // Assert.
        $this->assertNull($response);
    }
}
