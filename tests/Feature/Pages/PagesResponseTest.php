<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);
it('returns a successful response', function () {
    get(route('pages.home'))
        ->assertOk();
});

it('gives back successful response for course details page', function () {
    $course = \App\Models\Course::factory()->released()->create();

    get(route('pages.course-details', $course))
        ->assertOk();
});
