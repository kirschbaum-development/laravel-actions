<?php

namespace Kirschbaum\Actions;

use ReflectionClass;
use ReflectionException;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\ServiceProvider;
use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Commands\MakeActionCommand;

class ActionsServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        'actions' => Action::class,
        Action::class => Action::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerMergeConfig();
    }

    /**
     * Bootstrap any package services.
     *
     * @throws ReflectionException
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootConsoleCommands();

        $this->bootPublishConfig();

        $this->bootAutoDiscoverActions();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [Action::class];
    }

    /**
     * Auto-discover actions classes.
     *
     * @throws ReflectionException
     *
     * @return void
     */
    protected function bootAutoDiscoverActions(): void
    {
        $paths = collect(config('laravel-actions.paths'))
            ->unique()
            ->filter(function ($path) {
                return is_dir($path);
            });

        if ($paths->isEmpty()) {
            return;
        }

        $namespace = $this->app->getNamespace();

        foreach ((new Finder())->in($paths->toArray())->files() as $action) {
            $action = $namespace . str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($action->getRealPath(), realpath(app_path()) . DIRECTORY_SEPARATOR)
            );

            if (
                is_subclass_of($action, Actionable::class)
                && ! (new ReflectionClass($action))->isAbstract()
            ) {
                $this->app->bind($action, Action::class);
            }
        }
    }

    /**
     * Load console commands for actions.
     *
     * @return void
     */
    protected function bootConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeActionCommand::class,
            ]);
        }
    }

    /**
     * Publish action configuration file.
     *
     * @return void
     */
    protected function bootPublishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-actions.php' => config_path('laravel-actions.php'),
        ], 'laravel-actions');
    }

    /**
     * Register merging of configuration file.
     *
     * @return void
     */
    protected function registerMergeConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-actions.php',
            'laravel-actions'
        );
    }
}
