<?php

it('matches exact values', function () {
    expect(5)->not->toBeCloseTo(4.99, deviation: 0);
    expect(5)->toBeCloseTo(5, deviation: 0);
    expect(5)->not->toBeCloseTo(5.01, deviation: 0);
});

it('matches values with a close deviation', function () {
    expect(5)->not->toBeCloseTo(4.89, deviation: 0.1);
    expect(5)->toBeCloseTo(4.90, deviation: 0.1);
    expect(5)->toBeCloseTo(5.1, deviation: 0.1);
    expect(5)->not->toBeCloseTo(5.11, deviation: 0.1);
});
