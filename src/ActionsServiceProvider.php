<?php

namespace Kirschbaum\Actions;

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
        Actionable::class => Action::class,
    ];

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeActionCommand::class,
            ]);
        }
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
}
