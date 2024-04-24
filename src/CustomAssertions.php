<?php

namespace Spatie\PestExpectations;

use Illuminate\Testing\TestResponse;

trait CustomAssertions
{
    public function registerCustomAssertions(): void
    {
        $this->assertHasJsonApiPagination();
    }

    protected function assertHasJsonApiPagination(): void
    {
        TestResponse::macro('assertHasJsonApiPagination', function () {
            $this->assertJsonStructure([
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active',
                    ],
                ],
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
            ]);

            return $this;
        });
    }
}
