<?php

namespace Tests\Unit\Helpers;

use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\TestCase;

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
