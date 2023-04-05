<?php

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\ValidationRule;
use PHPUnit\Framework\ExpectationFailedException;
use Spatie\PestExpectations\Tests\TestSupport\LaravelRules\ValueShouldBeTrueInvokableRule;
use Spatie\PestExpectations\Tests\TestSupport\LaravelRules\ValueShouldBeTrueRule;

it('can determine that a validation rule passed', function (InvokableRule|ValidationRule $rule) {
    expect($rule)->toPassWith(true);
})->with('rules');

it('can fail when it expects the rule to pass and it did not', function (InvokableRule|ValidationRule $rule) {
    expect($rule)->toPassWith(false);
})->with('rules')->throws(ExpectationFailedException::class);

it('can determine that a validation rule did not pass', function (InvokableRule|ValidationRule $rule) {
    expect($rule)->toFailWith(false);
    expect($rule)->toFailWith(false, 'This is the validation message');
})->with('rules');

it('will fail when expecting the wrong validation message', function (InvokableRule|ValidationRule $rule) {
    expect($rule)->toFailWith(false, 'This is the wrong message');
})->with('rules')->throws(ExpectationFailedException::class);

dataset('rules', [
    new ValueShouldBeTrueInvokableRule(),
    new ValueShouldBeTrueRule(),
]);
