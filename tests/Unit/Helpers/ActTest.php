<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class ActTest extends TestCase
{
    public function testAct()
    {
        // Act.
        $response = act(ActionWithAllEvents::class);

        // Assert.
        $this->assertTrue($response);
    }
}
