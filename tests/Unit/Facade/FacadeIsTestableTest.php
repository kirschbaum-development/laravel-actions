<?php

namespace Tests\Unit\Facade;

use Illuminate\Foundation\Testing\WithFaker;
use Kirschbaum\Actions\Facades\Action;
use Mockery;
use Tests\Fixtures\CallFacadeMethods;
use Tests\TestCase;

class FacadeIsTestableTest extends TestCase
{
    use WithFaker;

    public function testActCanBeMocked()
    {
        // Assemble.
        Action::shouldReceive('act')
            ->once()
            ->with(Mockery::type('string'));

        // Act.
        (new CallFacadeMethods())->runActTest();
    }

    public function testActWhenCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        Action::shouldReceive('actWhen')
            ->once()
            ->with($condition, Mockery::type('string'));

        // Act.
        (new CallFacadeMethods())->runActWhenTest($condition);
    }

    public function testActUnlessCanBeMocked()
    {
        // Assemble.
        $condition = $this->faker()->boolean;

        Action::shouldReceive('actUnless')->once()
            ->once()
            ->with($condition, Mockery::type('string'));

        // Act.
        (new CallFacadeMethods())->runActUnlessTest($condition);
    }
}
