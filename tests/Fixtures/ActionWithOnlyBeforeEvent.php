<?php

namespace Tests\Fixtures;

use Throwable;
use Kirschbaum\Actions\Traits\CanAct;
use Tests\Fixtures\Events\BeforeEvent;
use Kirschbaum\Actions\Contracts\Actionable;

class ActionWithOnlyBeforeEvent implements Actionable
{
    use CanAct;

    /**
     * Event to dispatch before action starts.
     *
     * @var string
     */
    public $before = BeforeEvent::class;

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
