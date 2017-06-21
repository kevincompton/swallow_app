@extends('layouts.client')

@section('content')

  <div class="product-single">
    <div class="flex-container">
        <div class="product">
            <h3>{{ $product->name }}</h3>
            <div class="tags">
              @foreach($product->tags()->get() as $tag)
                <span>{{ $tag->title }}</span>
              @endforeach
            </div>

            <div class="product-info">
                <div class="images">
                    <div class="featured-image">
                        <img src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/{{ $product->image }}">
                    </div>
                    <div class="other-images">
                        
                    </div>
                </div><!-- end images -->

                <div class="copy">
                    <div class="meta">
                        <div><strong>Ingredients:</strong> <span>{{ $product->ingredients }}</span></div>
                        <div><strong>Strength:</strong> <span>{{ $product->strength }}</span></div>
                    </div>
                    <div class="description">
                        <strong>Description</strong>
                        <div>{{ $product->description }}</div>
                    </div>
                </div><!-- end info -->
            </div>
        </div>

    </div>
  </div>

@endsection