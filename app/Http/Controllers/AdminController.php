<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\AccountApproved;

class AdminController extends Controller
{
    
  public function index()
  {
      $pending_users = \App\User::pending()->get();
      $users = \App\User::approved()->get();
      $companies = \App\Company::all();

      $data = [
          "pending_users" => $pending_users,
          "users" => $users,
          "companies" => $companies
      ];

      return view('admin')->with($data);
  }

  public function approve($id)
  {
    $user = \App\User::find($id);
    $user->approved = 1;
    $user->save();

    Mail::to($user->email)->send(new AccountApproved);

    return back();
  }

}
