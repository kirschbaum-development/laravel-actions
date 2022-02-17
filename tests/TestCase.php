<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Kirschbaum\Actions\ActionsServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            ActionsServiceProvider::class,
        ];
    }
}
