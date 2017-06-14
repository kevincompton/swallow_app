<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    
    public function profile()
    {
      $user = Auth::user();

      $data = [
        "user" => $user
      ];

      return view('users.profile')->with($data);
    }

    public function update(Request $request)
    {
      $user = Auth::user();
      $user->company = $request->company;
      $user->category = $request->category;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();

      return back();
    }

}
