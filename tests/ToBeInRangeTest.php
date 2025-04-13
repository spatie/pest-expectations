<?php

it('passes assertion when value is in range', function () {
    expect(0)->not->toBeInRange(1, 10);
    expect(1)->toBeInRange(1, 10);
    expect(10)->toBeInRange(1, 10);
    expect(11)->not->toBeInRange(1, 10);
});

it('throws logical exception when min is greater than max', function () {
    expect(5)->toBeInRange(10, 1);
})->throws(InvalidArgumentException::class);
