<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class APIController extends Controller
{



  public function fetchProducts()
  {

    $products = \App\Product::all();

    foreach ($products as $key => $product) {
      if($product->users()->first()) {
        $product->company = $product->users()->first()->company;
      }
    }

    $data = [
      "products" => $products
    ];

    return $data;

  }

  public function fetchUserProducts()
  {
    $user = Auth::user();
    $company = \App\Company::find($user->company_id);
    $products = $company->products()->get();

    $data = [
      "products" => $products
    ];

    return $data;
  }

  public function fetchCompanies($category)
  {
    if($category == "edibles") {
      $companies = \App\Company::edibles()->get();
    } else {
      $companies = \App\Company::dispensaries()->get();
    }

    $data = [
      "companies" => $companies
    ];

    return $data;
  }

  public function wpUsers($category)
  {
    if($category == "edibles") {
      $companies = \App\WordpressUser::companies()->get();
    } else {
      $companies = \App\WordpressUser::dispensaries()->get();
    }

    $data = [
      "companies" => $companies
    ];

    return $data;
  }

  public function wpProducts($id)
  {
    $products = [];
    $company = \App\wpCompany::find($id);
    $productIDs = $company->products($id);

    foreach ($productIDs as $key => $id) {
      $product = \App\wpProduct::find($id->post_id);

      array_push($products, $product);
    }
    

    return var_dump($products);
  }

}
