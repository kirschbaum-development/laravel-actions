<?php

namespace Tests;

use Illuminate\Support\Facades\Event;
use Tests\Fixtures\Events\AfterEvent;
use Tests\Fixtures\Events\BeforeEvent;
use Tests\Fixtures\Events\FailedEvent;
use Tests\Fixtures\ActionWithAllEvents;
use Tests\Fixtures\ActionWithOnlyAfterEvent;
use Tests\Fixtures\ActionWithOnlyBeforeEvent;
use Tests\Fixtures\ActionWithOnlyFailedEvent;

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
        Event::assertNotDispatched(FailedEvent::class);
    }

    public function testBeforeAndFailedEventsDispatched()
    {
        // Assemble.
        Event::fake();

        // Act.
        // Passing `true` tells the action that the test should throw an exception.
        ActionWithAllEvents::act(true);

        // Assert.
        Event::assertDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
        Event::assertDispatched(FailedEvent::class);
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
        Event::assertNotDispatched(FailedEvent::class);
    }

    public function testOnlyBeforeEventDispatchedIfItFails()
    {
        // Assemble.
        Event::fake();

        // Act.
        // Passing `true` tells the action that the test should throw an exception.
        ActionWithOnlyBeforeEvent::act(true);

        // Assert.
        Event::assertDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
        Event::assertNotDispatched(FailedEvent::class);
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
        Event::assertNotDispatched(FailedEvent::class);
    }

    public function testOnlyAfterEventNotDispatchedIfItFails()
    {
        // Assemble.
        Event::fake();

        // Act.
        // Passing `true` tells the action that the test should throw an exception.
        ActionWithOnlyAfterEvent::act(true);

        // Assert.
        Event::assertNotDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
        Event::assertNotDispatched(FailedEvent::class);
    }

    public function testOnlyFailedEventNotDispatched()
    {
        // Assemble.
        Event::fake();

        // Act.
        ActionWithOnlyFailedEvent::act();

        // Assert.
        Event::assertNotDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
        Event::assertNotDispatched(FailedEvent::class);
    }

    public function testOnlyFailedEventDispatchedIfItFails()
    {
        // Assemble.
        Event::fake();

        // Act.
        // Passing `true` tells the action that the test should throw an exception.
        ActionWithOnlyFailedEvent::act(true);

        // Assert.
        Event::assertNotDispatched(BeforeEvent::class);
        Event::assertNotDispatched(AfterEvent::class);
        Event::assertDispatched(FailedEvent::class);
    }
}
