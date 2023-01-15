<?php

namespace Spatie\PestExpectations\Tests\TestSupport\LaravelRules;

use Illuminate\Contracts\Validation\InvokableRule;

class ValueShouldBeTrueRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if (! $value) {
            $fail('This is the validation message');
        }
    }
}
