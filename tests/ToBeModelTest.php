<?php

namespace Spatie\PestExpectations\Tests;

use Illuminate\Foundation\Auth\User;
use Spatie\PestExpectations\Tests\TestSupport\Models\Post;

beforeEach(function() {
   $this->user = User::create();

    $this->anotherUser =  User::create();

    $this->otherModel = Post::create();

});

it('can be a test if the given value is the same model', function() {
    expect($this->user)->toBeModel($this->user);
    expect($this->user)->not()->toBeModel($this->anotherUser);
    expect($this->user)->not()->toBe($this->otherModel);

    expect(null)->not()->toBeModel($this->user);
    expect($this->user)->not()->toBeModel(null);
    expect(null)->not()->toBeModel(null);
    expect(new User)->not()->toBeModel(new User);

});
