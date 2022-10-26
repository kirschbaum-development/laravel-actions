<?php

use Kirschbaum\Actions\Action;

if (! function_exists('act')) {
    /**
     * Initiate the given action.
     *
     * @param  string  $action
     * @param  mixed  ...$arguments
     *
     * @return mixed
     *
     * @throws Throwable
     */
    function act(string $action, ...$arguments)
    {
        return app(Action::class)->act($action, ...$arguments);
    }
}

if (! function_exists('act_when')) {
    /**
     * Initiate the given action if the given condition is true.
     *
     * @param $condition
     * @param  string  $action
     * @param  mixed  ...$arguments
     *
     * @return mixed
     *
     * @throws Throwable
     */
    function act_when($condition, string $action, ...$arguments)
    {
        return app(Action::class)->actWhen($condition, $action, ...$arguments);
    }
}

if (! function_exists('act_unless')) {
    /**
     * Initiate the given action if the given condition is false.
     *
     * @param $condition
     * @param  string  $action
     * @param  mixed  ...$arguments
     *
     * @return mixed
     *
     * @throws Throwable
     */
    function act_unless($condition, string $action, ...$arguments)
    {
        return app(Action::class)->actUnless($condition, $action, ...$arguments);
    }
}
