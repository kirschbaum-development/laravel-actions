<?php

use Kirschbaum\Actions\Action;

if (! function_exists('act')) {
    /**
     * Initiate the given action.
     *
     * @param string $action
     *
     * @throws Throwable
     *
     * @return mixed
     */
    function act(string $action)
    {
        return app(Action::class)->act($action, ...array_slice(func_get_args(), 1));
    }
}

if (! function_exists('act_when')) {
    /**
     * Initiate the given action if the given condition is true.
     *
     * @param $condition
     * @param string $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    function act_when($condition, string $action)
    {
        return app(Action::class)->actWhen($condition, $action, ...array_slice(func_get_args(), 2));
    }
}

if (! function_exists('act_unless')) {
    /**
     * Initiate the given action if the given condition is false.
     *
     * @param $condition
     * @param string $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    function act_unless($condition, string $action)
    {
        return app(Action::class)->actUnless($condition, $action, ...array_slice(func_get_args(), 2));
    }
}
