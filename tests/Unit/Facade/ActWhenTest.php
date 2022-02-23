<?php

namespace Tests\Unit\Facade;

use Tests\TestCase;
use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class ActWhenTest extends TestCase
{
    public function testActWhenRunsIfTruthy()
    {
        // Act.
        $response = Action::actWhen(true, ActionWithAllEvents::class);

        // Assert.
        $this->assertTrue($response);
    }

    public function testActWhenRejectsIfFalsy()
    {
        // Act.
        $response = Action::actWhen(false, ActionWithAllEvents::class);

        // Assert.
        $this->assertNull($response);
    }
}
