<?php

namespace Kirschbaum\Actions\Contracts;

use Throwable;

interface Actionable
{
    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function __invoke();

    /**
     * Handle failure of the action.
     *
     * @return mixed
     */
    public function failed(Throwable $exception);
}
