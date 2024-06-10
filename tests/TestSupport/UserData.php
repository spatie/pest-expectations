<?php

namespace Spatie\PestExpectations\Tests\TestSupport;

final class UserData
{
    public function __construct(
        public readonly string $full_name
    ) {
    }
}
