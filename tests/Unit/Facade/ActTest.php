<?php

namespace Tests\Unit\Facade;

use Tests\TestCase;
use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\ActionWithAllEvents;

class ActTest extends TestCase
{
    public function testAct()
    {
        // Act.
        $response = Action::act(new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }
}
