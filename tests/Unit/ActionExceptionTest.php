<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Fixtures\ActionWithException;
use Tests\Fixtures\ActionWithCustomException;
use Tests\Fixtures\Exceptions\CustomFailedException;
use Kirschbaum\Actions\Exceptions\ActionFailedException;

class ActionExceptionTest extends TestCase
{
    public function testExceptionThrown()
    {
        // Assemble.
        $this->expectException(ActionFailedException::class);

        // Act.
        ActionWithException::act();
    }

    public function testCustomExceptionThrown()
    {
        // Assemble.
        $this->expectException(CustomFailedException::class);

        // Act.
        ActionWithCustomException::act();
    }
}
