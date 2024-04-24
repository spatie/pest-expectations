<?php

namespace Spatie\PestExpectations\Tests\TestSupport;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\JsonApiPaginate\JsonApiPaginateServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            JsonApiPaginateServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}
