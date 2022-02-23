<?php

namespace Tests\Unit\Facade;

use Tests\TestCase;
use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class ActTest extends TestCase
{
    public function testAct()
    {
        // Act.
        $response = Action::act(ActionWithAllEvents::class);

        // Assert.
        $this->assertTrue($response);
    }
}
