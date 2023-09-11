<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows courses overview', function (){
    Course::factory()->create(['title' => 'Course A', 'description' => 'Description Course A', 'released_at' => \Carbon\Carbon::now()]);
    Course::factory()->create(['title' => 'Course B', 'description' => 'Description Course B', 'released_at' => \Carbon\Carbon::now()]);
    Course::factory()->create(['title' => 'Course C', 'description' => 'Description Course C', 'released_at' => \Carbon\Carbon::now()]);

    get(route('home'))
        ->assertSeeText([
            'Course A',
            'Description Course A',
            'Course B',
            'Description Course B',
            'Course C',
            'Description Course C'
        ]);
});
it('shows only released courses', function (){
    Course::factory()->create(['title' => 'Course A', 'released_at' => \Carbon\Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B']);

    get(route('home'))
        ->assertSeeText([
            'Course A',
        ])
        ->assertDontSeeText([
            'Course B',
        ]);
});
it('shows courses by released date', function (){
    Course::factory()->create(['title' => 'Course A', 'released_at' => \Carbon\Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'released_at' => \Carbon\Carbon::now()]);

    get(route('home'))
        ->assertSeeTextInOrder([
            'Course B',
            'Course A'
        ]);
});
