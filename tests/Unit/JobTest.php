<?php

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;

it('belongs to employer', function () {
   //AAA, Arrange, Act, Assert
   //Arrange
   $employer = Employer::factory()->create();
   $job = Job::factory()->create(['employer_id' => $employer->id]);
   //Act
   $job->employer;
   //Assert
   expect($job->employer->is($employer))->toBeTrue();
});

it('can have tags', function () {
    $job = Job::factory()->create();
    $job->tags()->attach(Tag::factory()->create());
    expect($job->tags()->count())->toBe(1);
});
