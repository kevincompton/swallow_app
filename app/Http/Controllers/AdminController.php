<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    
    public function index()
    {
        $pending_users = \App\User::pending()->get();
        $users = \App\User::approved()->get();

        $data = [
            "pending_users" => $pending_users,
            "users" => $users
        ];

        return view('admin')->with($data);
    }

    public function approve($id)
    {
      $user = \App\User::find($id);
      $user->approved = 1;
      $user->save();

      if($user->wordpress_id > 0 && $user->category == "edibles") {
        $wpCompany = \App\wpCompany::find($user->wordpress_id);
        $wpProducts = $wpCompany->products();

        foreach ($wpProducts as $key => $wpProduct) {
          $product = new \App\Product;
          
          $product->image = $this->fetchImage($wpProduct->post_id);
          $product->user_id = $user->id;
          $product->name = $this->fetchTitle($wpProduct->post_id);
          $product->ingredients = $this->fetchIngredients($wpProduct->post_id);
          $product->strength = $this->fetchStrength($wpProduct->post_id);
          $product->description = $this->fetchDescription($wpProduct->post_id);
          $product->wordpress_id = $wpProduct->post_id;

          $product->save();

          $user->products()->attach($product->id);

          DB::table('product_user')
            ->where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->update(['owner_id' => $user->id]);

          DB::table('product_user')
            ->where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->update(['approved' => true]);
          
        }

      }

      return back();
    }

    public function fetchMeta($meta_key, $post_id)
    {
      return DB::connection('wordpress')->table('wp_postmeta')
            ->where('meta_key', $meta_key)
            ->where('post_id', $post_id)
            ->select('meta_value')
            ->get();

    }

    public function fetchTitle($product_id)
    {

      $product = \App\wpProduct::find($product_id);
      return $product->post_title;

    }
    
    public function fetchImage($product_id)
    {

      $metaID = $this->fetchMeta('featured_image', $product_id);

      return $this->fetchMeta('_wp_attached_file', $metaID->first()->meta_value)->first()->meta_value;

    }

    public function fetchIngredients($product_id)
    {
      
      return $this->fetchMeta('ingredients', $product_id)->first()->meta_value;

    }

    public function fetchStrength($product_id)
    {
      
      return $this->fetchMeta('strength', $product_id)->first()->meta_value;

    }

    public function fetchDescription($product_id)
    {
      
      return $this->fetchMeta('description', $product_id)->first()->meta_value;

    }

}
