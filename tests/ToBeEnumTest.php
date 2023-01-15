<?php

use Spatie\PestExpectations\Tests\TestSupport\TestEnum;

it('can determine if the given value is the expected enum', function() {
    $value = TestEnum::first;

    expect($value)->toBeEnum(TestEnum::first);
    expect($value)->not()->toBeEnum(TestEnum::second);
    expect('non-enum')->not()->toBeEnum(TestEnum::first);
    expect('first')->not()->toBeEnum(TestEnum::first);

});
