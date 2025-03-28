<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
      if (!Auth::check()) {
        return view('user.login');
      } else {
        return redirect('/');
      }
    }

    public function create()
    {
      if (!Auth::check()) {
        return view('user.register');
      } else {
        return redirect('/');
      }
    }

    public function store()
    {
      //validate
      $userAttributes = request()->validate([
        'first_name' => ['required', 'min:3', 'max:255'],
        'last_name' => ['required', 'min:3', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'min:3', 'max:255', 'confirmed']
      ]);

      //store
      $user = User::create($userAttributes);
      //create session
      Auth::login($user);
      //redirect
      return redirect('/');
    }

    public function setSession()
    {
      //validate
      $userAttributes = request()->validate([
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'min:3', 'max:255']
      ]);

      //create session
      if (Auth::attempt($userAttributes)) {
        return redirect('/');
      } else {
        throw ValidationException::withMessages([
          'email' => 'Sorry, Your provided credentials did not match our records'
      ]);
      }
    }

    public function destroySession()
    {
      Auth::logout();
      return redirect('/');
    }
}
