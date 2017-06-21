@extends('layouts.client')

@section('content')

<div class="flex-container client-wrapper">
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

        <div class="dispensary-list">
            <h5>Available at</h5>
            <ul class="dispensaries">
                @foreach($dispensaries as $dispensary)
                    <li>
                        <a href="/dispensary/{{ $dispensary->id }}">
                            <div class="title">{{ $dispensary->name }}</div>
                            <div class="address">
                                {{ $dispensary->address }}<br>
                                {{ $dispensary->city }}, {{ $dispensary->state }} {{ $dispensary->zip_code }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        @if(isset($company->name))
            <div class="related container">
                <h5>More from <a href="/company/{{ $company->id }}">{{ $company->name }}</a></h5>

                <ul class="related-products">
                    @foreach($related_products as $product)
                        <li>
                            <a href="/product/{{ $product->id }}">
                                @if($product->image != "empty")
                                    <div class="product-image" style="background-image: url(https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/{{ $product->image }});"></div>
                                @else
                                    <div class="logo">
                                        <img class="lips" src="/images/logo/logo-lips-black.svg">
                                    </div>
                                @endif
                                <span>{{ $product->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

    </div>
  </div>
</div>

@endsection