<?php

namespace Tests\Unit\CanActTrait;

use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\TestCase;

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
