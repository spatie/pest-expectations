<?php

namespace Spatie\PestExpectations\Tests;

use Illuminate\Support\Facades\Route;
use Spatie\PestExpectations\Tests\TestSupport\Models\Post;

it('can check if it has pagination', function () {
    (new Post())->save();

    Route::any('/', function () {
        return Post::jsonPaginate();
    });

    $response = $this->get('/');

    expect($response)->toHavePagination();
});
