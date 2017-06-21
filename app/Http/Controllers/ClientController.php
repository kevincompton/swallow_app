<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ClientController extends Controller
{
    
    public function index()
    {

      $data = [];
      return view('client.index')->with($data);

    }

    public function education()
    {
      $data = [];

      return view('client.education')->with($data);
    }

    public function dispensaryIndex()
    {
      $dispensaries = \App\Company::dispensaries()->get();

      $data = [
        "dispensaries" => $dispensaries
      ];

      return view('client.dispensary_index')->with($data);
    }

    public function showProduct($id)
    {
      $product = \App\Product::find($id);
      $company = $product->companies()->get()->first();
      $related_products = $company->products()->get()->take(5);
      $dispensaries = $product->companies()->where('category', 'dispensary')->get();

      $data = [
        "product" => $product,
        "company" => $company,
        "related_products" => $related_products,
        "dispensaries" => $dispensaries
      ];

      return view('client.show_product')->with($data);
    }

    public function showCompany($id)
    {
      $company = \App\Company::find($id);
      $products = $company->products()->get();

      $data = [
        "products" => $products,
        "company" => $company
      ];

      return view('client.show_company')->with($data);
    }

    public function showDispensary($id)
    {
      $dispensary = \App\Company::find($id);
      $products = $dispensary->products()->get();

      $data = [
        "products" => $products,
        "dispensary" => $dispensary
      ];

      return view('client.show_dispensary')->with($data);
    }

    public function fetchProducts()
    {
      $products = \App\Product::active()->image()->get();

      foreach ($products as $key => $product) {
        $product->tags = $product->tags()->get();
        $product->s3_image = 'https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/' . $product->image;
      }

      $data = [
        "products" => $products
      ];

      return $data;
    }

    public function fetchTags()
    {
      $categories = \App\Category::all();

      foreach ($categories as $key => $category) {
        $category->tags = $category->tags()->get();

        foreach ($category->tags as $key => $tag) {
          $products = $tag->products()->get();
          $tagProducts = [];

          foreach ($products as $key => $product) {
            array_push($tagProducts, $product->id);
          }

          $tag->products = $tagProducts;
        }
      }

      $data = [
        "categories" => $categories
      ];

      return $data;
    }

}
