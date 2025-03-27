<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all()->groupBy('featured');

        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featured_jobs' => $jobs[1],
            'tags' => Tag::all(),
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'location' => ['required', 'min:3', 'max:255'],
            'salary' => ['required', 'min:3', 'max:255'],
            //make schedule to require either full-time or part-time
            'schedule' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'url' => 'required|url',
        ]);

        $job = Job::create($attributes);

        $job->tags()->attach($attributes['tags']);

        return redirect('/jobs');
    
    }
}
