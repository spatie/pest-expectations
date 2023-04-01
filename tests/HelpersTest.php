<?php

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\PestExpectations\Tests\TestSupport\LaravelRules\ValueShouldBeTrueRule;

it('will only define the helpers when calling the register function', function() {
    expect(function_exists('whenConfig'))->toBeFalse();

    registerSpatiePestHelpers();

    expect(function_exists('whenConfig'))->toBeTrue();

});
