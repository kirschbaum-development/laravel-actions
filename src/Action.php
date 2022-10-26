<?php

namespace Kirschbaum\Actions;

use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Exceptions\ActionableInterfaceNotFoundException;
use Throwable;

class Action
{
    /**
     * Arguments to pass into the action's constructor.
     *
     * @var array
     */
    protected $arguments;

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
    public function act(string $action, ...$arguments)
    {
        $this->arguments = $arguments;

        return $this->handle($action);
    }

    /**
     * Initiate the given action if the given condition is true.
     *
     * @param $condition
     * @param  string  $action
     * @param  mixed  ...$arguments
     *
     * @return mixed|void
     *
     * @throws Throwable
     */
    public function actWhen($condition, string $action, ...$arguments)
    {
        if ($condition) {
            $this->arguments = $arguments;

            return $this->handle($action);
        }
    }

    /**
     * Initiate the action if the given condition is false.
     *
     * @param $condition
     * @param  string  $action
     * @param  mixed  ...$arguments
     *
     * @return mixed|void
     *
     * @throws Throwable
     */
    public function actUnless($condition, string $action, ...$arguments)
    {
        if (! $condition) {
            $this->arguments = array_slice(func_get_args(), 2);

            return $this->handle($action);
        }
    }

    /**
     * Handle the given action.
     *
     * @param  string  $action
     *
     * @return mixed|void
     *
     * @throws Throwable
     */
    protected function handle(string $action)
    {
        $action = new $action(...$this->arguments);

        $this->checkActionForInterface($action);
        $this->raiseBeforeActionEvent($action);

        try {
            $response = $action();
        } catch (Throwable $exception) {
            return $this->handleFailure($action, $exception);
        }

        $this->raiseAfterActionEvent($action);

        return $response;
    }

    /**
     * Determine if the action has a `failed()` method defined.
     *
     * @param  Actionable  $action
     *
     * @return bool
     */
    protected function actionHasFailedMethod(Actionable $action): bool
    {
        return method_exists($action, 'failed');
    }

    protected function checkActionForInterface($action): void
    {
        throw_unless(
            $action instanceof Actionable,
            ActionableInterfaceNotFoundException::class
        );
    }

    /**
     * Dispatch appropriate action event.
     *
     * @param  string  $event
     * @param  Actionable  $action
     *
     * @return void
     */
    protected function dispatchEvent(string $event, Actionable $action): void
    {
        if ($this->eventExists($action, $event)) {
            // Gather method arguments except for the `$event` argument.
            $arguments = array_slice(func_get_args(), 1);

            event(new $action->{$event}(...$arguments));
        }
    }

    /**
     * Check if the given event exists in the action.
     *
     * @param  Actionable  $action
     * @param  string  $event
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
     * @param  Actionable  $action
     * @param  Throwable  $exception
     *
     * @return mixed
     *
     * @throws Throwable
     */
    protected function handleFailure(Actionable $action, Throwable $exception)
    {
        if ($this->actionHasFailedMethod($action)) {
            return $action->failed($exception);
        }

        if ($this->hasCustomException($action)) {
            $exception = $action->exception;

            throw new $exception();
        }

        throw $exception;
    }

    /**
     * Check if action has a custom exception.
     *
     * @param  Actionable  $action
     *
     * @return bool
     */
    protected function hasCustomException(Actionable $action): bool
    {
        return property_exists($action, 'exception')
            && class_exists($action->exception);
    }

    /**
     * Raise the before action event.
     *
     * @param  Actionable  $action
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
     * @param  Actionable  $action
     *
     * @return void
     */
    protected function raiseAfterActionEvent(Actionable $action): void
    {
        $this->dispatchEvent('after', $action);
    }
}
