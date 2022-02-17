<?php

use Kirschbaum\Actions\Action;
use Kirschbaum\Actions\Contracts\Actionable;

if (! function_exists('act')) {
    /**
     * Initiate the given action.
     *
     * @param Actionable $action
     *
     * @throws Throwable
     *
     * @return mixed
     */
    function act(Actionable $action)
    {
        return (new Action())->act($action);
    }
}

if (! function_exists('actWhen')) {
    /**
     * Initiate the given action if the given condition is true.
     *
     * @param $condition
     * @param Actionable $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    function actWhen($condition, Actionable $action)
    {
        return (new Action())->actWhen($condition, $action);
    }
}

if (! function_exists('actUnless')) {
    /**
     * Initiate the given action if the given condition is false.
     *
     * @param $condition
     * @param Actionable $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    function actUnless($condition, Actionable $action)
    {
        return (new Action())->actUnless($condition, $action);
    }
}
