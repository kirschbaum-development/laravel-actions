<?php

namespace Tests\Unit;

use Kirschbaum\Actions\Exceptions\ActionFailedException;
use Tests\Fixtures\Actions\ActionWithCustomException;
use Tests\Fixtures\Actions\ActionWithException;
use Tests\Fixtures\Exceptions\CustomFailedException;
use Tests\TestCase;

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
