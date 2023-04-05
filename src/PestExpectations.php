<?php

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\ValidationRule;

expect()->extend('toPassWith', function (mixed $value) {
    $rule = $this->value;

    if (! $rule instanceof InvokableRule && ! $rule instanceof ValidationRule) {
        throw new Exception('Value is not a rule');
    }

    $passed = true;

    $fail = function () use (&$passed) {
        $passed = false;
    };

    if ($rule instanceof InvokableRule) {
        $rule('attribute', $value, $fail);
    }

    if ($rule instanceof ValidationRule) {
        $rule->validate('attribute', $value, $fail);
    }

    expect($passed)->toBeTrue();

    return $this;
});

expect()->extend('toFailWith', function (mixed $value, string $expectedMessage = null) {
    $rule = $this->value;

    if (! $rule instanceof InvokableRule && ! $rule instanceof ValidationRule) {
        throw new Exception('Value is not a rule');
    }

    $passed = true;
    $actualMessage = null;

    $fail = function (string $message = null) use (&$passed, &$actualMessage) {
        $passed = false;

        $actualMessage = $message;
    };

    if ($rule instanceof InvokableRule) {
        $rule('attribute', $value, $fail);
    }

    if ($rule instanceof ValidationRule) {
        $rule->validate('attribute', $value, $fail);
    }

    expect($passed)->toBeFalse();

    if ($expectedMessage !== null) {
        expect($actualMessage)->toBe($expectedMessage);
    }

    return $this;
});

expect()->extend('toBeEnum', function (object $enum) {
    expect($this->value)->toBeInstanceOf(UnitEnum::class);
    expect($this->value->value)->toBe($enum->value);
});
