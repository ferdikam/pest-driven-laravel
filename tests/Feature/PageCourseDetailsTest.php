<?php

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('show course details', function () {
    $course = \App\Models\Course::factory()->create([
        'tagline' => 'Course tagline',
        'image' => 'image.png',
        'learnings' => [
            'Learn laravel routes',
            'Learn laravel views',
            'Learn laravel commands',
        ],
    ]);

    get(route('course-details', $course))
        ->assertOk()
        ->assertSeeText([
            $course->title,
            $course->description,
            'Course tagline',
            'Learn laravel routes',
            'Learn laravel views',
            'Learn laravel commands',
        ])
        ->assertSee('image.png');
});

it('shows course video count', function () {
    $this->withoutExceptionHandling();
    $course = \App\Models\Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => $course->id]);

    get(route('course-details', $course))
        ->assertSeeText('3 videos');
});
