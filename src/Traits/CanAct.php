<?php

namespace Kirschbaum\Actions\Traits;

use Throwable;
use Kirschbaum\Actions\Action;

trait CanAct
{
    /**
     * Handle the action.
     *
     * @param ...$arguments
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public static function act(...$arguments)
    {
        return (new Action())->act(new static(...$arguments));
    }

    /**
     * Handle the action if the given condition is true.
     *
     * @param $condition
     * @param ...$arguments
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public static function actWhen($condition, ...$arguments)
    {
        return (new Action())->actWhen($condition, new static(...$arguments));
    }

    /**
     * Handle the action if the given condition is false.
     *
     * @param $condition
     * @param ...$arguments
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public static function actUnless($condition, ...$arguments)
    {
        return (new Action())->actUnless($condition, new static(...$arguments));
    }
}
