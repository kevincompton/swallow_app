<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;

class ImportController extends Controller
{

    public function syncCompanies()
    {
      $wpCompanies = \App\wpCompany::companies()->get();
      $wpIDs = DB::table('companies')->select('wordpress_id')->get();

      foreach ($wpCompanies as $key => $wpCompany) {

        if($wpIDs->contains('wordpress_id', $wpCompany->ID)) {
          echo 'skipped company ' . $wpCompany->ID;
        } else {

          $company = new \App\Company;
          $company->name = $wpCompany->post_title;
          $company->category = "edibles";
          $company->website = $this->syncMeta('website', $wpCompany->ID);
          $company->instagram = $this->syncMeta('instagram', $wpCompany->ID);
          $company->description = $this->syncMeta('info', $wpCompany->ID);
          $company->wordpress_id = $wpCompany->ID;
          $company->save();

          $this->attachProducts($wpCompany->ID);

          echo "added company " . $wpCompany->ID;
        }

      }

    }

    public function attachProducts()
    {
      $companies = \App\Company::all();

      foreach ($companies as $key => $company) {
        $product_keys = DB::connection('wordpress')->table('wp_postmeta')
                ->where('meta_key', 'like', 'product%')
                ->where('post_id', $company->wordpress_id)
                ->select('meta_value')
                ->get();

        if(count($product_keys) > 0) {
          foreach ($product_keys as $key => $product_key) {
            $product_id = DB::table('products')
                          ->where('wordpress_id', $product_key->meta_value)
                          ->select('id')
                          ->get();

            if(count($product_id) > 0) {
              $company->products()->attach($product_id->first()->id);
            }
          }
        }
        
      }

    }
    
    public function syncProducts()
    {
      $wProducts = \App\wpProduct::products()->get();
      $wpIDs = DB::table('products')->select('wordpress_id')->get();

      foreach ($wProducts as $key => $wProduct) {

        if($wpIDs->contains('wordpress_id', $wProduct->ID)) {
          echo 'skipped product ' . $wProduct->ID;
        } else {

          $product = new \App\Product;
          $product->name = $wProduct->post_title;
          $product->ingredients = $this->syncMeta('ingredients', $wProduct->ID);
          $product->strength = $this->syncMeta('strength', $wProduct->ID);
          $product->description = $this->syncMeta('description', $wProduct->ID);
          $product->wordpress_id = $wProduct->ID;
          if($this->syncImage($wProduct->ID) == null) {
            $product->image = 'nothing';
          } else {
            $product->image = $this->syncImage($wProduct->ID);
          }
          $product->user_id = 0;
          if($wProduct->post_status == "draft") {
            $product->deactivate = true;
          }

          $product->save();

          echo 'added product ' . $product->wordpress_id;

        }
      
      }
        
      return 'done';
    }

    public function syncTags()
    {
      $products = \App\Product::all();

      foreach ($products as $key => $product) {
        
        $terms = DB::connection('wordpress')->table('wp_term_relationships')
                ->where('object_id', $product->wordpress_id)
                ->select('term_taxonomy_id')
                ->get();

        foreach ($terms as $key => $term) {
          
          $tag = DB::table('tags')
                  ->where('wp_term_id', $term->term_taxonomy_id)
                  ->get();

          if(isset($tag->first()->id)) {
            $product->tags()->attach($tag->first()->id);
          }

        }

      }

      return 'done';
    }

    public function syncImage($wp_id)
    {

      $image_id = $this->syncMeta('featured_image', $wp_id);
      $image_s3_info = $this->syncMeta('amazonS3_info', $image_id);
      $image_s3_info = substr($image_s3_info, strpos($image_s3_info, 'wp-content'));
      $image_path = strtok($image_s3_info, '"');

      return $image_path;

    }

    private function syncMeta($handle, $wp_id)
    {
      if(isset($this->fetchMeta($handle, $wp_id)->first()->meta_value)) {
        return $this->fetchMeta($handle, $wp_id)->first()->meta_value;
      } else {
        return 'empty';
      }
    }

    private function fetchMeta($meta_key, $post_id)
    {


      $query = DB::connection('wordpress')->table('wp_postmeta')
            ->where('meta_key', $meta_key)
            ->where('post_id', $post_id)
            ->select('meta_value')
            ->get();

      return $query;

    }

}
