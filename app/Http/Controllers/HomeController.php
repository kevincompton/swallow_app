<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $data = [
            "user" => $user
        ];

        if($user->approved == false) {
            return view('pending')->with($data);
        } elseif($user->admin == true) {
            return redirect('/admin');
        } elseif($user->category == "edibles") {
            return $this->edibles();
        } elseif($user->category == "dispensary") {
            return $this->dispensary();
        }

    }

    public function dispensary()
    {
        $user = Auth::user();
        $company = \App\Company::find($user->company_id);

        $products = $company->products()->active()->get();

        $data = [
            "user" => $user,
            "company" => $company,
            "products" => $products
        ];

        return view('home.dispensaries')->with($data);
    }

    public function edibles()
    {
        $user = Auth::user();
        $company = \App\Company::find($user->company_id);
        $products = DB::table('products')
            ->where('brand_id', $company->id)
            ->get();

        $deactivated_products = $company->products()->deactivated()->get();
        $links = null;
        $dispensaries = null;

        $links = DB::table('product_user')
            ->where('owner_id', $user->id)
            ->where('user_id', '!=', $user->id)
            ->where('approved', false)
            ->get();

        foreach ($links as $key => $link) {
            $link->user = \App\User::find($link->user_id)->company;
            $link->product = \App\Product::find($link->product_id)->name;
        }

        $dispensaries = DB::table('product_user')
            ->where('owner_id', $user->id)
            ->where('user_id', '!=', $user->id)
            ->where('approved', true)
            ->get();

        foreach ($dispensaries as $key => $dispensary) {
            $dispensary->company = \App\User::find($dispensary->user_id)->company;
        }

        $data = [
            "user" => $user,
            "company" => $company,
            "products" => $products,
            "deactivated_products" => $deactivated_products,
            "links" => $links,
            "dispensaries" => $dispensaries
        ];


        return view('home.edibles')->with($data);
    }

}















