<?php

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\PestExpectations\Tests\TestSupport\LaravelRules\ValueShouldBeTrueRule;

it('can determine that a validation rule passed', function () {
    expect(new ValueShouldBeTrueRule())->toPassWith(true);
});

it('can fail when it expects the rule to pass and it did not', function () {
    expect(new ValueShouldBeTrueRule())->toPassWith(false);
})->throws(ExpectationFailedException::class);

it('can determine that a validation rule did not pass', function() {
    expect(new ValueShouldBeTrueRule())->toFailWith(false);
    expect(new ValueShouldBeTrueRule())->toFailWith(false, 'This is the validation message');
});

it('will fail when expecting the wrong validation message', function() {
    expect(new ValueShouldBeTrueRule())->toFailWith(false, 'This is the wrong message');
})->throws(ExpectationFailedException::class);




