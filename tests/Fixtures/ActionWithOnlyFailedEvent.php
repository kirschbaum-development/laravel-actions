<?php

namespace Tests\Fixtures;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\FailedEvent;
use Kirschbaum\Actions\Contracts\Actionable;

class ActionWithOnlyFailedEvent implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch if action throws an exception.
     *
     * @var string
     */
    public $failed = FailedEvent::class;

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
