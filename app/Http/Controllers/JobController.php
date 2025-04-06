<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all()->groupBy('featured');
    
        return view('jobs.index', [
            'jobs' => $jobs[0] ?? collect(), // Use an empty collection if key 0 doesn't exist
            'featured_jobs' => $jobs[1] ?? collect(), // Use an empty collection if key 1 doesn't exist
            'tags' => Tag::all(),
        ]);
    }

    public function viewJob($slug)
    {
        //fetch job by slug
        $job = Job::where('slug', $slug)->firstOrFail();
        //fetch tags attached to that job
        $tags = $job->tags;
        return view('jobs.view', [
            'job' => $job,
            'tags' => $tags,
        ]);
    }
}
