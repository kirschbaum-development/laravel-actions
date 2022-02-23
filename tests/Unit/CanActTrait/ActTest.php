<?php

namespace Tests\Unit\CanActTrait;

use Tests\TestCase;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class ActTest extends TestCase
{
    public function testAct()
    {
        // Act.
        $response = ActionWithAllEvents::act();

        // Assert.
        $this->assertTrue($response);
    }
}
