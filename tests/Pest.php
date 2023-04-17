<?php

use Spatie\PestExpectations\Tests\TestSupport\TestCase;

uses(TestCase::class)
    ->beforeEach(function () {
        ray()->newScreen(test()->name());
    })
    ->in(__DIR__);
