<?php

namespace Tests\Unit;

use Kirschbaum\Actions\Action;
use Tests\Fixtures\Actions\ActionWithNoEvents;
use Tests\TestCase;

class MacroableTest extends TestCase
{
    public function testMacrosWorkAndPassesActionClassIntoMacro()
    {
        // Assemble.
        Action::macro('test', function ($action) {
            return $action;
        });

        // Act.
        $results = ActionWithNoEvents::test();

        // Assert.
        $this->assertEquals(ActionWithNoEvents::class, $results);
    }
}
