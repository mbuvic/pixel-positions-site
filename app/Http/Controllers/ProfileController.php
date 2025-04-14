<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

  public function showDashboard()
  {
    return view('user.dashboard');
  }

  public function editAJob($slug)
  {
    $job = Job::where('slug', $slug)->firstOrFail();
    $job_tags = $job->tags;

    return view('user.edit-job', [
        'job' => $job,
        'job_tags' => $job_tags,
        'all_tags' => Tag::all()
    ]);

  }

  public function updateAJob()
  {
    //validate incoming request data
    $request = request();

    // Convert comma separated tags string into an array
    $request->merge([
        'tags' => explode(',', $request->input('tags'))
    ]);

    $attributes = $request->validate([
        'job_id' => 'required|integer',
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

    //Create slug from title
    $attributes['slug'] = str($attributes['title'])->slug();


    //make sure slug is unique select where slug = attributes['slug'] and id != request()->input('job_id')
    $slugCount = Job::where('slug', $attributes['slug'])->where('id', '!=', request()->input('job_id'))->count();
    if ($slugCount > 0) {
        $attributes['slug'] = $attributes['slug'] . '-' . $slugCount;
    }

    //Update the job in the database
    $job = Job::where('id', request()->input('job_id'))->firstOrFail();
    $job->update($attributes);

    return redirect()->back()->with('success', 'Job updated successfully!');
  }

  public function deleteAJob($jobId)
  {
    $job = Job::where('id', $jobId)->firstOrFail();
    $job->delete();

    return redirect('/user/my-jobs')->with('success', 'Job deleted successfully!');
  } 

  public function showMyJobs()
  {
      $user = auth()->user();
  
      if (!$user || !$user->employer) {
        return view('user.company-profile');
      }
  
      $myJobs = $user->employer->jobs;
  
      return view('user.my-jobs', [
          'myJobs' => $myJobs
      ]);
  }
  
  public function showUser()
  {
    return view('user.profile');
  }

  public function updateUser()
  {
      // Validate incoming request data
      $userAttributes = request()->validate([
          'first_name' => ['required', 'min:3', 'max:255'],
          'last_name'  => ['required', 'min:3', 'max:255'],
          'email'      => ['required', 'email', 'max:255'],
          'password'   => 'nullable|confirmed|min:6'
      ]);

      // Retrieve the authenticated user
      $user = auth()->user();
  
      // Update basic attributes
      $user->first_name = $userAttributes['first_name'];
      $user->last_name  = $userAttributes['last_name'];
      $user->email      = $userAttributes['email'];
  
      // Update password only if provided
      if (!empty($userAttributes['password'])) {
          $user->password = bcrypt($userAttributes['password']);
      }
  
      // Save the changes to the database
      $user->save();
  
      // Redirect back with a success message
      return redirect()->back()->with('success', 'Profile updated successfully!');
  }  

  public function showUserCompany()
  {
    return view('user.company-profile');
  }

  public function updateUserCompany()
  {
    // Validate incoming request data
    $companyAttributes = request()->validate([
        'company_name' => 'nullable|min:5|max:255',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
    ]);

    //move the file to the resources folder
    if (request()->hasFile('company_logo')) {
      $companyAttributes['company_logo'] = request()->file('company_logo')->store('company_logos', 'public');
    }

    // Retrieve the authenticated user
    $employer = auth()->user()->employer;

    if ($employer === null) {
      // Create a new Employer instance and insert to db
      $employer = Employer::create([
        'user_id' => auth()->user()->id,
        'name' => $companyAttributes['company_name'],
        'logo' => $companyAttributes['company_logo']
      ]);
    } else {
      // Update basic attributes
      $employer->name = $companyAttributes['company_name'] ? $companyAttributes['company_name'] : $employer->name;
      $employer->logo = isset($companyAttributes['company_logo']) ? $companyAttributes['company_logo'] : $employer->logo;
  
      // Save the changes to the database
      $employer->save();
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Profile updated successfully!');

  }

  public function showJobCreateForm()
  {
    if (auth()->user()->employer == null) {
      return redirect('/user/company-profile');
    } else {
      return view('user.create-job', [
        'tags' => Tag::all()
      ]);
    }
  }

  public function storeJob()
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

      //Add the employer_id to the attributes
      $attributes['employer_id'] = auth()->user()->employer->id;

      //Create slug from title
      $attributes['slug'] = str($attributes['title'])->slug();
      

      //make sure slug is unique
      $slugCount = Job::where('slug', $attributes['slug'])->count();
      if ($slugCount > 0) {
          $attributes['slug'] = $attributes['slug'] . '-' . $slugCount;
      }

      //Write the job to the database
      $job = Job::create($attributes);

      //Attach the tags
      $job->tags()->attach($attributes['tags']);

      //Redirect
      return redirect()->back()->with('success', 'Job added successfully!');
  }
}
