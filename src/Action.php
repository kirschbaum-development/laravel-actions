<?php

namespace Kirschbaum\Actions;

use Exception;
use Illuminate\Support\Traits\Macroable;
use Kirschbaum\Actions\Contracts\Actionable;
use Kirschbaum\Actions\Exceptions\ActionableInterfaceNotFoundException;
use Throwable;

class Action
{
    use Macroable;

    /**
     * Arguments to pass into the action's constructor.
     *
     * @var array<int|string, mixed>
     */
    protected array $arguments;

    /**
     * Initiate the given action.
     *
     * @param  mixed  ...$arguments
     *
     * @return mixed|void
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
     * @template TValue
     *
     * @param  TValue  $condition
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
     * @template TValue
     *
     * @param  TValue  $condition
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
     *
     * @return mixed|void
     *
     * @throws Throwable
     */
    protected function handle(string $action)
    {
        $action = new $action(...$this->arguments);

        throw_unless(
            $action instanceof Actionable,
            ActionableInterfaceNotFoundException::class
        );

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
     */
    protected function actionHasFailedMethod(Actionable $action): bool
    {
        return method_exists($action, 'failed');
    }

    /**
     * Dispatch the appropriate action event.
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
     */
    protected function eventExists(Actionable $action, string $event): bool
    {
        return property_exists($action, $event)
            && class_exists($action->{$event});
    }

    /**
     * Fire failure event and/or call failed action method if they exist.
     *
     * @return mixed|void
     *
     * @throws Throwable
     */
    protected function handleFailure(Actionable $action, Throwable $exception)
    {
        if ($this->actionHasFailedMethod($action)) {
            /**
             * @var callable $callback
             */
            $callback = [$action, 'failed'];

            return call_user_func($callback, $exception);
        }

        if ($this->hasCustomException($action)) {
            $properties = get_object_vars($action);

            /**
             * @var Exception $exception
             */
            $exception = $properties['exception'];

            throw new $exception();
        }

        throw $exception;
    }

    /**
     * Check if the action has a custom exception.
     */
    protected function hasCustomException(Actionable $action): bool
    {
        return property_exists($action, 'exception')
            && class_exists($action->exception);
    }

    /**
     * Raise the "before" action event.
     */
    protected function raiseBeforeActionEvent(Actionable $action): void
    {
        $this->dispatchEvent('before', $action);
    }

    /**
     * Raise the "after" action event.
     */
    protected function raiseAfterActionEvent(Actionable $action): void
    {
        $this->dispatchEvent('after', $action);
    }
}
