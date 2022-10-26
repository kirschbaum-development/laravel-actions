<?php

namespace Kirschbaum\Actions\Traits;

trait CanAct
{
    /**
     * Handles static method calls by passing them to the Action class.
     *
     * @param  string  $name
     * @param  array  $arguments
     *
     * @return mixed|void
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (in_array($name, ['act', 'actWhen', 'actUnless'])) {
            $action = app(get_called_class());

            if ($name === 'act') {
                return $action->act(get_called_class(), ...$arguments);
            }

            return $action->$name(
                $arguments[0],
                get_called_class(),
                ...array_slice($arguments, 1)
            );
        }
    }
}
