<?php

namespace Tests\Unit\Helpers;

use Mockery;
use Tests\TestCase;
use Kirschbaum\Actions\Action;
use Tests\Fixtures\CallHelperMethods;
use Illuminate\Foundation\Testing\WithFaker;

class HelpersAreTestableTest extends TestCase
{
    use WithFaker;

    public function testActCanBeMocked()
    {
        // Assemble.
        $this->mock(Action::class, function ($mock) {
            $mock->shouldReceive('act')
                ->once()
                ->with(Mockery::type('string'));
        });

        // Act.
        (new CallHelperMethods())->runActTest();
    }

    public function testActWhenCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        $this->mock(Action::class, function ($mock) use ($condition) {
            $mock->shouldReceive('actWhen')
                ->once()
                ->with($condition, Mockery::type('string'));
        });

        // Act.
        (new CallHelperMethods())->runActWhenTest($condition);
    }

    public function testActUnlessCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        $this->mock(Action::class, function ($mock) use ($condition) {
            $mock->shouldReceive('actUnless')->once()
                ->once()
                ->with($condition, Mockery::type('string'));
        });

        // Act.
        (new CallHelperMethods())->runActUnlessTest($condition);
    }
}
