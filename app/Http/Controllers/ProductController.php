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

      $this->validate($request, [
        'name' => 'required|unique:posts|max:255',
        'ingredients' => 'required',
        'description' => 'required',
      ]);

      $tags = $request->filter;
      $user = Auth::user();
      $company = \App\Company::find($user->company_id);

      $product = new \App\Product;
      $product->image = '';
      $product->user_id = $user->id;
      $product->name = $request->name;
      $product->ingredients = $request->ingredients;
      $product->strength = $request->strength_cbd . ' ' . $request->strength_thc;
      $product->description = $request->description;
      $product->wordpress_id = 0;
      $product->brand_id = $company->id;
      $product->save();

      foreach ($tags as $key => $tag) {
        $product->tags()->attach($tag);
      }

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

      return back();
    }

    public function deactivate($id)
    {
      $product = \App\Product::find($id);
      $product->deactivate = true;
      $product->save();

      return back();
    }

    public function activate($id)
    { 
      $product = \App\Product::find($id);
      $product->deactivate = false;
      $product->save();

      return back();
    }

    public function delete($id)
    {
      $product = \App\Product::find($id);
      $product->delete();

      return back();
    }

    
    public function unlink($id)
    {
      $product = \App\Product::find($id);
      $user = Auth::user();
      $company = \App\Company::find($user->company_id);

      $company->products()->detach($id);

      return back();
    }

    public function linkProduct(Request $request)
    {
      

      $user = Auth::user();
      $company = \App\Company::find($user->company_id);
      
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
