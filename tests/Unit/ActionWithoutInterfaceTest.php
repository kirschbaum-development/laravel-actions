<?php

namespace Tests\Unit;

use Kirschbaum\Actions\Exceptions\ActionableInterfaceNotFoundException;
use Kirschbaum\Actions\Facades\Action;
use Tests\Fixtures\Actions\ActionWithoutInterface;
use Tests\TestCase;

class ActionWithoutInterfaceTest extends TestCase
{
    public function testExceptionThrownIfActionDoesNotImplementInterfaceFromFacade()
    {
        // Assemble.
        $this->expectException(ActionableInterfaceNotFoundException::class);

        // Act.
        Action::act(ActionWithoutInterface::class);
    }

    public function testExceptionThrownIfActionDoesNotImplementInterfaceFromHelper()
    {
        // Assemble.
        $this->expectException(ActionableInterfaceNotFoundException::class);

        // Act.
        act(ActionWithoutInterface::class);
    }
}
