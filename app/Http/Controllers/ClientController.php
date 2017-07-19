<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use DB;

class ClientController extends Controller
{
    
    public function welcome(Request $request)
    {
      $categories = \App\Category::all();

      $data = [
        "categories" => $categories
      ];

      return view('client.welcome')->with($data);
    }

    public function confirmAge()
    {
      return response('confirmed')->cookie(
        'age', 'confirmed', 9999
      );
    }

    public function results(Request $request)
    {
      $inputs = $request->all();

      if(isset($inputs["search"])) {
        $search = $inputs["search"];
      } else {
        $search = null;
      }
      
      unset($inputs["search"]);
      unset($inputs["_token"]);

      return redirect('/edibles?tags=' . implode(",",$inputs) . '&search=' . $search);
    }

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
      $dispensaries = $this->setLocation($_GET['latitude'], $_GET['longitude']);
      $products = new \Illuminate\Database\Eloquent\Collection;

      foreach ($dispensaries as $key => $dispensary) {
        $company = \App\Company::find($dispensary->id);
        $products = $products->merge($company->products()->active()->image()->get());
      }

      foreach ($products as $key => $product) {
        $product->tags = $product->tags()->get();
        $brand = \App\Company::find($product->brand_id);
        if($brand != null){
          $product->full_name = $brand->name . ' ' . $product->name;
        } else {
          $product->full_name = $product->name;
        }
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

    private function setLocation($latitude, $longitude)
    {

      $circle_radius = 3959;

      // set these as vars from the call
      $max_distance = 10;
      $lat = 34.166412;
      $lng = -118.592979;

      return $companies = DB::select(
                 'SELECT * FROM
                      (SELECT id, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                      cos(radians(longitude) - radians(' . $lng . ')) +
                      sin(radians(' . $lat . ')) * sin(radians(latitude))))
                      AS distance
                      FROM companies) AS distances
                  WHERE distance < ' . $max_distance . '
                  ORDER BY distance;
              ');

    }

}




/*

private function setLocation($latitude, $longitude)
  {

    $circle_radius = 3959;

    // set these as vars from the call
    $max_distance = 10;
    $lat = 34.166412;
    $lng = -118.592979;

    return $companies = DB::select(
               'SELECT * FROM
                    (SELECT *, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
                    AS distance
                    FROM companies) AS distances
                WHERE distance < ' . $max_distance . '
                ORDER BY distance;
            ');

    // select dispensaries and return to fetchProducts
  }

  public function fetchProducts()
  {
    $dispensaries = $this->setLocation($_GET['latitude'], $_GET['longitude']);
    $products = [];

    foreach ($dispensaries as $key => $dispensary) {
      array_push($products, $dispensary->products()->get());
    }

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


  */
