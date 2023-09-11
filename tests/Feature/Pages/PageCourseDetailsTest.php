<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('does not find unreleashed Course', function () {
    $course = Course::factory()
                ->create();

    get(route('pages.course-details', $course))
        ->assertNotFound();
});

it('show course details', function () {
    $course = Course::factory()
        ->released()
        ->create();

    get(route('pages.course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            $course->tagline,
            ...$course->learnings,
        ])
        ->assertSee(asset("/images/$course->image_name"));
});

it('shows course video count', function () {
    $course = Course::factory()
        ->released()
        ->has(Video::factory()->count(3))
        ->create();

    get(route('pages.course-details', $course))
        ->assertSeeText('3 videos');
});
