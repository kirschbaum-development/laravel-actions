<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class ActUnlessTest extends TestCase
{
    public function testActUnlessRunsIfFalsy()
    {
        // Act.
        $response = act_unless(false, ActionWithAllEvents::class);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActUnlessRejectsIfTruthy()
    {
        // Act.
        $response = act_unless(true, ActionWithAllEvents::class);

        // Assert.
        $this->assertNull($response);
    }
}
