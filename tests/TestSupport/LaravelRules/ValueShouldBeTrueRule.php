<?php

namespace Spatie\PestExpectations\Tests\TestSupport\LaravelRules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValueShouldBeTrueRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $value) {
            $fail('This is the validation message');
        }
    }
}
