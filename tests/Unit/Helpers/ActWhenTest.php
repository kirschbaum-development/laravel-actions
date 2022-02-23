<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class ActWhenTest extends TestCase
{
    public function testActWhenRunsIfTruthy()
    {
        // Act.
        $response = act_when(true, ActionWithAllEvents::class);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActWhenRejectsIfFalsy()
    {
        // Act.
        $response = act_when(false, ActionWithAllEvents::class);

        // Assert.
        $this->assertNull($response);
    }
}
