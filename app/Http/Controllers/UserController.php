<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
      dd($userAttributes);
      User::create($userAttributes);
      //create session 
      //redirect
    }
}
