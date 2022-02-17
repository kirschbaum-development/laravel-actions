<?php

namespace Kirschbaum\Actions;

use Throwable;
use Illuminate\Support\Arr;
use Kirschbaum\Actions\Contracts\Actionable;

class Action
{
    /**
     * Initiate the given action.
     *
     * @param Actionable $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    public function act(Actionable $action)
    {
        return $this->handle($action);
    }

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
    public function actWhen($condition, Actionable $action)
    {
        if ($condition) {
            return $this->act($action);
        }
    }

    /**
     * Initiate the action if the given condition is false.
     *
     * @param $condition
     * @param Actionable $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    public function actUnless($condition, Actionable $action)
    {
        return $this->actWhen(! $condition, $action);
    }

    /**
     * Handle the given action.
     *
     * @param Actionable $action
     *
     * @throws Throwable
     *
     * @return mixed|void
     */
    protected function handle(Actionable $action)
    {
        $this->raiseBeforeActionEvent($action);

        try {
            $response = $action();
        } catch (Throwable $throwable) {
            $this->handleFailure($action, $throwable);

            return;
        }

        $this->raiseAfterActionEvent($action);

        return $response;
    }

    /**
     * Dispatch appropriate action event.
     *
     * @param string $event
     * @param Actionable $action
     * @param Throwable|null $exception
     *
     * @return void
     */
    protected function dispatchEvent(string $event, Actionable $action, ?Throwable $exception = null): void
    {
        if ($this->eventExists($action, $event)) {
            // Gather method arguments except for the `$event` argument.
            $arguments = Arr::except(func_get_args(), 0);

            event(new $action->{$event}(...$arguments));
        }
    }

    /**
     * Check if the given event exists in the action.
     *
     * @param Actionable $action
     * @param string $event
     *
     * @return bool
     */
    protected function eventExists(Actionable $action, string $event): bool
    {
        return property_exists($action, $event)
            && class_exists($action->{$event});
    }

    /**
     * Fire failure event and/or call failed action method if they exist.
     *
     * @param Actionable $action
     * @param Throwable $throwable
     *
     * @return void
     */
    protected function handleFailure(Actionable $action, Throwable $throwable): void
    {
        $this->raiseExceptionOccurredActionEvent($action, $throwable);

        if (method_exists($action, 'failed')) {
            $action->failed($throwable);
        }
    }

    /**
     * Raise the before action event.
     *
     * @param Actionable $action
     *
     * @return void
     */
    protected function raiseBeforeActionEvent(Actionable $action): void
    {
        $this->dispatchEvent('before', $action);
    }

    /**
     * Raise the after action event.
     *
     * @param Actionable $action
     *
     * @return void
     */
    protected function raiseAfterActionEvent(Actionable $action): void
    {
        $this->dispatchEvent('after', $action);
    }

    /**
     * Raise the exception occurred action event.
     *
     * @param Actionable $action
     * @param Throwable $throwable
     *
     * @return void
     */
    protected function raiseExceptionOccurredActionEvent(Actionable $action, Throwable $throwable): void
    {
        $this->dispatchEvent('failed', $action, $throwable);
    }
}
