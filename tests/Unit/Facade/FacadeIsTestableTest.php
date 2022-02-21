<?php

namespace Tests\Unit\Facade;

use Mockery;
use Tests\TestCase;
use Tests\Fixtures\CallFacadeMethods;
use Kirschbaum\Actions\Facades\Action;
use Illuminate\Foundation\Testing\WithFaker;
use Kirschbaum\Actions\Contracts\Actionable;

class FacadeIsTestableTest extends TestCase
{
    use WithFaker;

    public function testActCanBeMocked()
    {
        // Assemble.
        Action::shouldReceive('act')
            ->once()
            ->with(Mockery::type(Actionable::class));

        // Act.
        (new CallFacadeMethods())->runActTest();
    }

    public function testActWhenCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        Action::shouldReceive('actWhen')
            ->once()
            ->with($condition, Mockery::type(Actionable::class));

        // Act.
        (new CallFacadeMethods())->runActWhenTest($condition);
    }

    public function testActUnlessCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        Action::shouldReceive('actUnless')->once()
            ->once()
            ->with($condition, Mockery::type(Actionable::class));

        // Act.
        (new CallFacadeMethods())->runActUnlessTest($condition);
    }
}
