<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);
it('returns a successful response', function () {
    get(route('home'))
        ->assertOk();
});

it('gives back successful response for course details page', function () {
    $course = \App\Models\Course::factory()->create();

    get(route('course-details', $course))
        ->assertOk();
});
