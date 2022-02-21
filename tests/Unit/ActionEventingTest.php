<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Tests\Fixtures\Events\AfterEvent;
use Tests\Fixtures\ActionWithNoEvents;
use Tests\Fixtures\Events\BeforeEvent;
use Tests\Fixtures\ActionWithAllEvents;
use Tests\Fixtures\ActionWithOnlyAfterEvent;
use Tests\Fixtures\ActionWithOnlyBeforeEvent;

class ActionEventingTest extends TestCase
{
    public function testBeforeAndAfterEventsDispatched()
    {
        // Assemble.
        Event::fake();

        // Act.
        ActionWithAllEvents::act();

        // Assert.
        Event::assertDispatched(BeforeEvent::class);
        Event::assertDispatched(AfterEvent::class);
    }

    public function testOnlyBeforeEventDispatched()
    {
        // Assemble.
        Event::fake();

        // Act.
        ActionWithOnlyBeforeEvent::act();

        // Assert.
        Event::assertDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
    }

    public function testOnlyAfterEventDispatched()
    {
        // Assemble.
        Event::fake();

        // Act.
        ActionWithOnlyAfterEvent::act();

        // Assert.
        Event::assertNotDispatched(BeforeEvent::class);
        Event::assertDispatched(AfterEvent::class);
    }

    public function testNoEventsDispatched()
    {
        // Assemble.
        Event::fake();

        // Act.
        ActionWithNoEvents::act();

        // Assert.
        Event::assertNotDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
    }
}
