<?php

namespace Kirschbaum\Actions;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Kirschbaum\Actions\Commands\MakeActionCommand;
use Kirschbaum\Actions\Contracts\Actionable;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Finder\Finder;

class ActionsServiceProvider extends ServiceProvider
{
    /**
     * All the container bindings that should be registered.
     *
     * @var array<class-string<Action>|string,class-string<Action>>
     */
    public array $bindings = [
        'actions' => Action::class,
        Action::class => Action::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerMergeConfig();
    }

    /**
     * Bootstrap any package services.
     *
     *
     * @throws ReflectionException
     */
    public function boot(): void
    {
        $this->bootConsoleCommands();

        $this->bootPublishConfig();

        $this->bootAutoDiscoverActions();

        $this->bootActionMacro();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return list<class-string<Action>>
     */
    public function provides(): array
    {
        return [Action::class];
    }

    /**
     * Boot macro needed for action functionality.
     */
    protected function bootActionMacro(): void
    {
        Action::macro('getMacro', function (string $name): callable|object {
            /**
             * @phpstan-ignore-next-line
             */
            return static::$macros[$name];
        });
    }

    /**
     * Auto-discover actions classes.
     *
     * @throws ReflectionException
     */
    protected function bootAutoDiscoverActions(): void
    {
        /**
         * @var list<string> $configPaths
         */
        $configPaths = config('laravel-actions.paths');

        $paths = collect($configPaths)
            ->unique()
            ->filter(function (string $path): bool {
                return is_dir($path);
            });

        if ($paths->isEmpty()) {
            return;
        }

        /**
         * @var list<string> $dirs
         */
        $dirs = $paths->toArray();

        foreach ((new Finder())->in($dirs)->files() as $action) {
            if (preg_match('#(namespace)(\\s+)([A-Za-z0-9\\\\]+?)(\\s*);#sm', $action->getContents(), $namespaceMatches)) {
                $action = (string) Str::of($namespaceMatches[3])
                    ->finish('\\')
                    ->append($action->getBasename('.php'));

                if (
                    is_subclass_of($action, Actionable::class)
                    && ! (new ReflectionClass($action))->isAbstract()
                ) {
                    $this->app->bind($action, Action::class);
                }
            }
        }
    }

    /**
     * Load console commands for actions.
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
     */
    protected function bootPublishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-actions.php' => config_path('laravel-actions.php'),
        ], 'laravel-actions');
    }

    /**
     * Register merging of configuration file.
     */
    protected function registerMergeConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-actions.php',
            'laravel-actions'
        );
    }
}
