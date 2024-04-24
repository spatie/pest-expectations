<?php

namespace Spatie\PestExpectations\Tests\TestSupport\Scheduled;

use Illuminate\Console\Command;

final class CommandClass extends Command
{
    protected $signature = 'foo:bar';
}
