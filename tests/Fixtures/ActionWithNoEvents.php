<?php

namespace Tests\Fixtures;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Kirschbaum\Actions\Contracts\Actionable;

class ActionWithNoEvents implements Actionable
{
    use CanAct;

    /**
     * @var bool
     */
    protected $fail;

    /**
     * Create a new action instance.
     *
     * @param bool $fail
     */
    public function __construct(bool $fail = false)
    {
        $this->fail = $fail;
    }

    /**
     * Execute the action.
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public function __invoke()
    {
        // This is just for testing failure.
        throw_if($this->fail, Throwable::class);

        return true;
    }
}
