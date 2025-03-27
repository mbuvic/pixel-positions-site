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
}
