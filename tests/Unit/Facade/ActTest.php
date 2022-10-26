<?php

namespace Tests\Unit\Facade;

use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\TestCase;

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
