<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function showUser() {
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

  public function showUserCompany() {
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
}
