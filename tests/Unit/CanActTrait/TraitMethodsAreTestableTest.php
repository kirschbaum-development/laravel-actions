<?php

namespace Tests\Unit\Helpers;

use Mockery;
use Tests\TestCase;
use Tests\Fixtures\CallCanTraitMethods;
use Illuminate\Foundation\Testing\WithFaker;
use Kirschbaum\Actions\Contracts\Actionable;

class TraitMethodsAreTestableTest extends TestCase
{
    use WithFaker;

    public function testActCanBeMocked()
    {
        // Assemble.
        $this->mock(Actionable::class, function ($mock) {
            $mock->shouldReceive('act')
                ->once()
                ->with(Mockery::type(Actionable::class));
        });

        // Act.
        (new CallCanTraitMethods())->runActTest();
    }

    public function testActWhenCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        $this->mock(Actionable::class, function ($mock) use ($condition) {
            $mock->shouldReceive('actWhen')
                ->once()
                ->with($condition, Mockery::type(Actionable::class));
        });

        // Act.
        (new CallCanTraitMethods())->runActWhenTest($condition);
    }

    public function testActUnlessCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        $this->mock(Actionable::class, function ($mock) use ($condition) {
            $mock->shouldReceive('actUnless')->once()
                ->once()
                ->with($condition, Mockery::type(Actionable::class));
        });

        // Act.
        (new CallCanTraitMethods())->runActUnlessTest($condition);
    }
}
