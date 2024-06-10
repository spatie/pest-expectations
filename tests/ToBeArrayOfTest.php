<?php

use Illuminate\Database\Eloquent\Model;
use Spatie\PestExpectations\Tests\TestSupport\Models\Post;
use Spatie\PestExpectations\Tests\TestSupport\TestEnum;
use Spatie\PestExpectations\Tests\TestSupport\UserData;

test('expects given arrays to be of specified types', function (array $array, string|object $expect) {
    expect($array)->toBeArrayOf($expect);
})->with([
    // specific scalar values
    [['foo', 'bar'], 'string'],
    [[1, 2], 'int'],
    [[1, 2], 'integer'],
    [[1.1, 2.2], 'float'],
    [[true, false], 'bool'],
    [[true, false], 'boolean'],
    [[['foo', 'bar'], ['baz', 'qux']], 'array'],
    [[null, null], 'null'],
    // generic scalar
    [['foo', 'bar'], 'scalar'],
    [[1, 2], 'scalar'],
    [[1.1, 2.2], 'scalar'],
    [[true, false], 'scalar'],
    [[1, 'foo', 1.1, true], 'scalar'],
    // objects
    [[new stdClass(), new stdClass()], stdClass::class],
    [[new stdClass(), new stdClass()], new stdClass()],
    [[new stdClass(), new stdClass()], 'object'],
    [[new stdClass(), (object) []], stdClass::class],
    // enums
    [[TestEnum::first, TestEnum::second], TestEnum::class],
    [[TestEnum::first, TestEnum::second], BackedEnum::class],
    // class
    [[new UserData('Jon Doe'), new UserData('Jane Doe')], UserData::class],
    [[new UserData('Jon Doe'), new UserData('Jane Doe')], new UserData('Jane Doe')],
    [[new Post(), new Post()], Post::class],
    [[new Post(), new Post()], Model::class],
]);

test('expects given arrays not to be of specified types', function (array $array, string|object $expect) {
    expect($array)->not->toBeArrayOf($expect);
})->with([
    // classes with other classes
    [[new stdClass(), new UserData('Jon Doe')], UserData::class],
    [[new Post(), new stdClass()], UserData::class],
    [[new stdClass(), new UserData('Jon Doe')], stdClass::class],
    [[new Post(), new stdClass()], stdClass::class],
    // scalar
    [[1, 2.2], 'int'],
    [[1, 2.2], 'float'],
    [[1, '1'], 'int'],
    [[1, '1'], 'string'],
    [[1.0, '1'], 'float'],
    [[1.0, '1'], 'string'],
]);
