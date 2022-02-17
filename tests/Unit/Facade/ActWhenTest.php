<?php

namespace Tests\Unit\Facade;

use Tests\TestCase;
use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\ActionWithAllEvents;

class ActWhenTest extends TestCase
{
    public function testActWhenRunsIfTruthy()
    {
        // Act.
        $response = Action::actWhen(true, new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }

    public function testActWhenRejectsIfFalsy()
    {
        // Act.
        $response = Action::actWhen(false, new ActionWithAllEvents());

        // Assert.
        $this->assertNull($response);
    }
}
