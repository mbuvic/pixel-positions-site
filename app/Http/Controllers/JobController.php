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
  

    public function create()
    {
      if (auth()->user()->employer == null) {
        return redirect('/user/company-profile');
      } else {
        return view('jobs.create', [
          'tags' => Tag::all()
        ]);
      }
    }

    public function store()
    {
        $request = request();

        // Convert comma separated tags string into an array
        $request->merge([
            'tags' => explode(',', $request->input('tags'))
        ]);
    
        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'location' => ['required', 'min:3', 'max:255'],
            'salary' => ['required', 'min:3', 'max:255'],
            // Restrict schedule to "full-time" or "part-time"
            'schedule' => ['required', Rule::in(['full-time', 'part-time'])],
            'description' => ['required', 'min:3'],
            'url' => 'required|url',
            // Validate that tags is an array with a minimum of 1 and maximum of 3 items
            'tags' => 'required|array|min:3|max:4',
        ]);

        // Store the original tags from the request before you overwrite them
        $originalTags = $attributes['tags'];

        // Get the matching IDs from the database
        $dbTagIds = Tag::whereIn('name', $originalTags)->pluck('id')->toArray();

        // Check if we got fewer tags back from the DB than were provided
        if (count($dbTagIds) !== count($originalTags)) {
            return redirect()
                ->back()
                ->withErrors(['tags' => 'One or more tags are not valid'])
                ->withInput();
        }

        // Overwrite $attributes['tags'] with the valid IDs
        $attributes['tags'] = $dbTagIds;

        //Write the job to the database
        $job = Job::create($attributes);

        //Attach the tags
        $job->tags()->attach($attributes['tags']);

        //Redirect
        return redirect('/jobs');
    
    }
}
