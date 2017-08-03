<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Contracts\Filesystem\Filesystem;

class ProductController extends Controller
{
    

    public function create(Request $request)
    {
      $user = Auth::user();
      $company = \App\Company::find($user->company_id);

      $product = new \App\Product;
      $product->image = '';
      $product->user_id = $user->id;
      $product->name = $request->name;
      $product->ingredients = $request->ingredients;
      $product->strength = $request->strength;
      $product->description = $request->description;
      $product->wordpress_id = 0;
      $product->brand_id = $company->id;
      $product->save();

      if($request->file('image') != null) {
        $image = $request->file('image');
        $imageFileName = time() . '.' . $image->getClientOriginalExtension();

        $s3 = \Storage::disk('s3');
        $filePath = '/wp-content/uploads/' . $imageFileName;
        $s3->put($filePath, file_get_contents($image), 'public');
        $product->image = $imageFileName;
      }

      $product->save();

      $product->companies()->attach($company->id);

      //$this->wpCreate($product->id);

      return back();
    }

    public function deactivate($id)
    {
      $product = \App\Product::find($id);
      $product->deactivate = true;
      $product->save();

      $this->wpPublish($product->wordpress_id, 'draft');

      return back();
    }

    public function activate($id)
    { 
      $product = \App\Product::find($id);
      $product->deactivate = false;
      $product->save();

      $this->wpPublish($product->wordpress_id, 'publish');

      return back();
    }

    public function delete($id)
    {
      $product = \App\Product::find($id);
      $this->wpPublish($product->wordpress_id, 'draft');
      $product->delete();

      return back();
    }

    private function wpPublish($wp_id, $status)
    {

      $product = \App\wpProduct::find($wp_id);
      $product->post_status = $status;
      $product->save();

      return;
    }

    private function wpCreate($id)
    {
      $product = \App\Product::find($id);

      $wpProduct = new \App\wpProduct;
      $wpProduct->timestamps = false;
      $wpProduct->post_title = $product->name;
      $wpProduct->post_name = "vendor-api-" . $product->id;
      $wpProduct->post_type = "product";

      $wpProduct->save();

      $product->wordpress_id = $wpProduct->ID;
      $product->save();

      return $this->wpCreateMeta($wpProduct->ID, $product->id);
    }

    private function wpCreateMeta($wp_id, $id)
    {
      $product = \App\Product::find($id);
      $wpProduct = \App\Product::find($wp_id);
      $company = null;
      $user = Auth::user();

      if(isset($userID)) {
        $user = \App\User::find($userID);
      }

      if($user->category == "edibles") {
        $company = "company";
      } else {
        $company = "dispensary";
      }

      $this->createMeta('ingredients', $product->ingredients, $wpProduct->ID);
      $this->createMeta('strength', $product->strength, $wpProduct->ID);
      $this->createMeta('description', $product->description, $wpProduct->ID);
      $this->createMeta($company, $user->wordpress_id, $wpProduct->ID);
      
      return $this->wpRelate($wpProduct->ID);      

    }

    private function createMeta($meta_key, $update, $wpProductID)
    {

      $meta = new \App\wpMeta;
      $meta->meta_key = $meta_key;
      $meta->post_id = $wpProductID;
      $meta->meta_value = $update;
      $meta->save();

    }

    public function unlink($id)
    {
      $product = \App\Product::find($id);
      $user = Auth::user();

      $user->products()->detach($id);
      $user->save();

      return back();
    }

    public function linkProduct(Request $request)
    {
      

      $user = Auth::user();
      $company = \App\Company::find($user->company_id);

      return $request->product_id . ' ' . $company->id;
      
      $company->products()->attach($request->product_id);

      return back();
    }

    public function approveLink($userID, $productID)
    {
      $product = \App\Product::find($productID);
      $user = \App\User::find($userID);

      if($product->user_id != Auth::user()->id) {
        return back();
      }

      DB::table('product_user')
            ->where('user_id', $userID)
            ->where('product_id', $product->id)
            ->update(['approved' => true]);

      $this->createMeta("dispensary", $user->wordpress_id, $product->id);

      return back();

    }

    public function edit($id)
    {
      $product = \App\Product::find($id);
      $user = Auth::user();

      if($product->brand_id != $user->company_id) {
        return back();
      }

      $data = [
        "product" => $product,
        "user" => $user
      ];

      return view('products.edit')->with($data);
    }

    private function updateWordpress(Request $request, $id)
    {
      $product = \App\Product::find($id);
      $user = Auth::user();

      $wpProduct = \App\wpProduct::find($product->wordpress_id);
      $wpProduct->timestamps = false;
      $wpProduct->post_title = $request->name;
      $wpProduct->save();

      $this->updateWPIngredients($product->wordpress_id, $request->ingredients);
      $this->updateWPStrength($product->wordpress_id, $request->strength);
      $this->updateWPDescription($product->wordpress_id, $request->description);

      return;
    }

    private function setMeta($meta_key, $post_id, $update)
    {

      return DB::connection('wordpress')->table('wp_postmeta')
            ->where('meta_key', $meta_key)
            ->where('post_id', $post_id)
            ->update(['meta_value' => $update]);

    }

    private function updateWPIngredients($id, $update)
    {

      return $this->setMeta('ingredients', $id, $update);

    }

    private function updateWPStrength($id, $update)
    {

      return $this->setMeta('strength', $id, $update);

    }

    private function updateWPDescription($id, $update)
    {

      return $this->setMeta('description', $id, $update);

    }

    public function update(Request $request, $id)
    {
      $product = \App\Product::find($id);
      $user = Auth::user();

      if($request->image != null) {
        $image = $request->file('image');
        $imageFileName = time() . '.' . $image->getClientOriginalExtension();

        $s3 = \Storage::disk('s3');
        $filePath = '/wp-content/uploads/' . $imageFileName;
        $s3->put($filePath, file_get_contents($image), 'public');
        $product->image = $imageFileName;
      }

      $product->name = $request->name;
      if(isset($request->ingredients)) {
        $product->ingredients = $request->ingredients;
      }
      if(isset($request->strength)) {
        $product->strength = $request->strength;
      }
      if(isset($request->description)) {
        $product->description = $request->description;
      }
      $product->save();

      $this->updateWordpress($request, $product->id);

      return back();

    }

}
