<?php

namespace Tests\Unit\CanActTrait;

use Tests\TestCase;
use Tests\Fixtures\CallCanTraitMethods;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Fixtures\Actions\ActionWithAllEvents;

class TraitMethodsAreTestableTest extends TestCase
{
    use WithFaker;

    public function testActCanBeMocked()
    {
        // Assemble.
        $this->mock(ActionWithAllEvents::class, function ($mock) {
            $mock->shouldReceive('act')
                ->once()
                ->with(ActionWithAllEvents::class);
        });

        // Act.
        (new CallCanTraitMethods())->runActTest();
    }

    public function testActWhenCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        $this->mock(ActionWithAllEvents::class, function ($mock) use ($condition) {
            $mock->shouldReceive('actWhen')
                ->once()
                ->with($condition, ActionWithAllEvents::class);
        });

        // Act.
        (new CallCanTraitMethods())->runActWhenTest($condition);
    }

    public function testActUnlessCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        $this->mock(ActionWithAllEvents::class, function ($mock) use ($condition) {
            $mock->shouldReceive('actUnless')
                ->once()
                ->with($condition, ActionWithAllEvents::class);
        });

        // Act.
        (new CallCanTraitMethods())->runActUnlessTest($condition);
    }
}
