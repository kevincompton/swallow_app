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
        $tags = \App\Tag::all();

        $products = $company->products()->active()->get();
        $owned_products = DB::table('products')
            ->where('brand_id', $company->id)
            ->get();

        foreach ($owned_products as $key => $product) {
            $products->prepend($product);
        }

        $data = [
            "user" => $user,
            "company" => $company,
            "products" => $products,
            "tags" => $tags
        ];

        return view('home.dispensaries')->with($data);
    }

    public function edibles()
    {
        $dispensaries = collect(new \App\Company);
        $user = Auth::user();
        $tags = \App\Tag::all();
        $company = \App\Company::find($user->company_id);
        $products = DB::table('products')
            ->where('brand_id', $company->id)
            ->get();

        $deactivated_products = $company->products()->deactivated()->get();
        $links = null;

        $links = DB::table('product_user')
            ->where('owner_id', $user->id)
            ->where('user_id', '!=', $user->id)
            ->where('approved', false)
            ->get();

        foreach ($links as $key => $link) {
            $link->user = \App\User::find($link->user_id)->company;
            $link->product = \App\Product::find($link->product_id)->name;
        }

        $related_dispensaries = DB::table('dispensaries_edibles')
            ->where('edible_id', $company->id)
            ->select('dispensary_id')
            ->get();

        if(isset($related_dispensaries[0])) {
            foreach ($related_dispensaries[0] as $key => $related) {
                $dispensary = \App\Company::find($related);
                $dispensaries->prepend($dispensary);
            }
        }

        $data = [
            "user" => $user,
            "company" => $company,
            "products" => $products,
            "deactivated_products" => $deactivated_products,
            "links" => $links,
            "dispensaries" => $dispensaries,
            "tags" => $tags
        ];


        return view('home.edibles')->with($data);
    }

}















