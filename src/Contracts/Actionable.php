<?php

namespace Kirschbaum\Actions\Contracts;

interface Actionable
{
    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function __invoke();
}
