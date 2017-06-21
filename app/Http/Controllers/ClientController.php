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

    public function show($id)
    {
      $product = \App\Product::find($id);

      $data = [
        "product" => $product
      ];

      return view('client.show')->with($data);
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
