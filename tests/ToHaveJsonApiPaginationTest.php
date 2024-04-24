<?php

namespace Spatie\PestExpectations\Tests;

use Illuminate\Support\Facades\Route;
use Spatie\PestExpectations\Tests\TestSupport\Models\Post;

it('can assert on an expect', function () {
    (new Post())->save();

    Route::any('/', function () {
        return Post::jsonPaginate();
    });

    $response = $this->get('/');

    expect($response)->toHaveJsonApiPagination();
});

it('can assert on a test response', function () {
    Route::any('/', function () {
        return Post::jsonPaginate();
    });

    $this
        ->get('/')
        ->assertOk()
        ->assertHasJsonApiPagination();
});
