<?php

namespace Tests\Fixtures\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BeforeEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
}
