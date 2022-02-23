<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Tests\Fixtures\Events\AfterEvent;
use Tests\Fixtures\Events\BeforeEvent;
use Tests\Fixtures\Actions\ActionWithNoEvents;
use Tests\Fixtures\Actions\ActionWithAllEvents;
use Tests\Fixtures\Actions\ActionWithOnlyAfterEvent;
use Tests\Fixtures\Actions\ActionWithOnlyBeforeEvent;

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
