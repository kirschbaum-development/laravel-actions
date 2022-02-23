<?php

namespace Tests;

use ReflectionClass;
use Illuminate\Support\Str;
use Kirschbaum\Actions\Action;
use Symfony\Component\Finder\Finder;
use Illuminate\Foundation\Application;
use Kirschbaum\Actions\Contracts\Actionable;
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

    /**
     * Define environment setup.
     *
     * @param Application $app
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    protected function defineEnvironment($app)
    {
        $path = __DIR__ . '/Fixtures/Actions';

        foreach ((new Finder())->in($path)->files() as $action) {
            $action = 'Tests\\' . str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($action->getRealPath(), realpath(__DIR__) . DIRECTORY_SEPARATOR)
            );

            if (
                is_subclass_of($action, Actionable::class)
                && ! (new ReflectionClass($action))->isAbstract()
            ) {
                $app->bind($action, Action::class);
            }
        }
    }
}
