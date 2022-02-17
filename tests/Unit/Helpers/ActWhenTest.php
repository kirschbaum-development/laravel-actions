<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\ActionWithAllEvents;

class ActWhenTest extends TestCase
{
    public function testActWhenRunsIfTruthy()
    {
        // Act.
        $response = act_when(true, new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }

    public function testActWhenRejectsIfFalsy()
    {
        // Act.
        $response = act_when(false, new ActionWithAllEvents());

        // Assert.
        $this->assertNull($response);
    }
}
