<?php

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\CallbackEvent;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Translation\PotentiallyTranslatedString;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

expect()->extend('toPassWith', function (mixed $value) {
    $rule = $this->value;

    if (! $rule instanceof InvokableRule && ! $rule instanceof ValidationRule) {
        throw new Exception('Value is not a rule');
    }

    $passed = true;

    $fail = function (?string $message = null) use (&$passed) {
        $passed = false;

        return new PotentiallyTranslatedString($message ?? 'attribute', app('translator'));
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

expect()->extend('toFailWith', function (mixed $value, ?string $expectedMessage = null) {
    $rule = $this->value;

    if (! $rule instanceof InvokableRule && ! $rule instanceof ValidationRule) {
        throw new Exception('Value is not a rule');
    }

    $passed = true;
    $actualMessage = null;

    $fail = function (?string $message = null) use (&$passed, &$actualMessage) {
        $passed = false;

        $translator = app('translator');

        $actualMessage = (new PotentiallyTranslatedString($message ?? 'attribute', $translator))
            ->translate()
            ->toString();

        return new PotentiallyTranslatedString($message ?? 'attribute', $translator);
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

expect()->extend('toBeModel', function ($argument) {
    expect($argument)->toBeInstanceOf(Model::class, 'Argument is not a model');
    expect($this->value)->toBeInstanceOf(Model::class, 'Value is not a model');

    expect($this->value)->toBeInstanceOf($argument::class, 'Value is not an instance of '.get_class($argument));

    expect($this->value->getKey())->not()->toBeNull('Value model was not saved yet...');
    expect($argument->getKey())->not()->toBeNull('Argument model was not saved yet...');

    expect($this->value->getKey())->toBe($argument->getKey(), 'Value is not the same model');
});

expect()->extend('toBeScheduled', function (string|\Closure $callback) {
    expect(class_exists($this->value))->toBeTrue("Expected `{$this->value}` to be a class.");

    $schedule = resolve(Schedule::class);
    $event = collect($schedule->events())->first(function (CallbackEvent|Event $event) {
        if ($event instanceof CallbackEvent) {
            return $event->getSummaryForDisplay() === $this->value;
        }

        if ($event instanceof Event && is_a($this->value, Command::class, allow_string: true)) {
            /** @var Command */
            $command = resolve($this->value);

            return str_contains($event->command, $command->getName());
        }
    });

    assertNotNull($event, sprintf('Expected `%s` to be scheduled.', $this->value));

    if (is_string($callback)) {
        $callback = fn (CallbackEvent|Event $event) => assertEquals($callback, $event->expression);
    }

    $callback($event);

    return $this;
});

expect()->extend('toHaveJsonApiPagination', function () {
    expect($this->value)->assertJsonStructure([
        'links' => [
            '*' => [
                'url',
                'label',
                'active',
            ],
        ],
        'meta' => [
            'current_page',
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ],
    ]);
});
