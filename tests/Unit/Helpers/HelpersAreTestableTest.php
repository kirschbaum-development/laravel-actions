<?php

namespace Tests\Unit\Helpers;

use Illuminate\Foundation\Testing\WithFaker;
use Kirschbaum\Actions\Action;
use Mockery;
use Tests\Fixtures\CallHelperMethods;
use Tests\TestCase;

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
