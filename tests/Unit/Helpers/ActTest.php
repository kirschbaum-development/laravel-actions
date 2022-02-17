<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\ActionWithAllEvents;

class ActTest extends TestCase
{
    public function testAct()
    {
        // Act.
        $response = act(new ActionWithAllEvents());

        // Assert.
        $this->assertTrue($response);
    }
}
