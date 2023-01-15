<?php

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\PestExpectations\Tests\TestSupport\LaravelRules\ValidationRule;

it('can determine that a validation rule passed', function () {
    expect(new ValidationRule())->toPassWith(true);
});

it('can fail when it expects the rule to pass and it did not', function () {
    expect(new ValidationRule())->toPassWith(false);
})->throws(ExpectationFailedException::class);

it('can determine that a validation rule did not pass', function () {
    expect(new ValidationRule())->toFailWith(false);
    expect(new ValidationRule())->toFailWith(false, 'This is the validation message');
});

it('will fail when expecting the wrong validation message', function () {
    expect(new ValidationRule())->toFailWith(false, 'This is the wrong message');
})->throws(ExpectationFailedException::class);
