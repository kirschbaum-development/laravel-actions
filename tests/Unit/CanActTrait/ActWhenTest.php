<?php

namespace Tests\Unit\CanActTrait;

use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\TestCase;

class ActWhenTest extends TestCase
{
    public function testActWhenRunsIfTruthy()
    {
        // Act.
        $response = ActionWithAllEvents::actWhen(true);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActWhenRejectsIfFalsy()
    {
        // Act.
        $response = ActionWithAllEvents::actWhen(false);

        // Assert.
        $this->assertNull($response);
    }
}
