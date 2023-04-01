<?php

it('will only define the helpers when calling the register function', function () {
    expect(function_exists('whenConfig'))->toBeFalse();

    registerSpatiePestHelpers();

    expect(function_exists('whenConfig'))->toBeTrue();
});
