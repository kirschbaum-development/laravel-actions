<?php

namespace Kirschbaum\Actions\Traits;

use Throwable;
use Kirschbaum\Actions\Action;
use Kirschbaum\Actions\Contracts\Actionable;

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
        return app(Actionable::class)->act(new static(...$arguments));
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
        return app(Actionable::class)->actWhen($condition, new static(...$arguments));
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
        return app(Actionable::class)->actUnless($condition, new static(...$arguments));
    }

    /**
     * Handle failure of the action.
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public function failed(Throwable $exception)
    {
        if ($this->hasCustomException()) {
            throw new $this->exception();
        }

        throw $exception;
    }

    /**
     * Check if action has a custom exception.
     *
     * @return bool
     */
    protected function hasCustomException(): bool
    {
        return property_exists($this, 'exception')
            && class_exists($this->exception);
    }
}
