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
        return view('user.index');
    }

    public function create()
    {
        return view('user.register');
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
