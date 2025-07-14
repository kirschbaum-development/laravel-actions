<?php

namespace Kirschbaum\Actions\Traits;

use BadMethodCallException;
use Closure;
use Kirschbaum\Actions\Action;

trait CanAct
{
    /**
     * Handles static method calls by passing them to the Action class.
     *
     * @return mixed|void
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (in_array($name, ['act', 'actWhen', 'actUnless'])) {
            $action = app(static::class);

            if ($name === 'act') {
                return $action->act(static::class, ...$arguments);
            }

            return $action->$name(
                $arguments[0],
                static::class,
                ...array_slice($arguments, 1)
            );
        }

        if (! Action::hasMacro($name)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $name
            ));
        }

        $macro = Action::getMacro($name);

        if ($macro instanceof Closure) {
            $macro = $macro->bindTo(null, Action::class);
        }

        return $macro(static::class, ...$arguments);
    }
}
