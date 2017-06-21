@extends('layouts.client')

@section('content')

    <div class="flex-container client-wrapper">
      <div class="company-single">   
        <div>

            <div class="company-info">
                <h3>{{ $company->name }}</h3>
                <div class="flex-container">
                    <div class="left-column">
                        <img class="featured-image" src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/{{ $company->logo }}">
                    </div>
                    <div class="right-column">
                        <div class="website"><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></div>
                        <div class="social-media"><strong>Instagram:</strong> {{ $company->instagram }}</div>

                        <div class="description">
                            <strong>Company Info: </strong>
                            <div>{{ $company->description }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inventory-products">
              <h5>Products from <span>{{ $company->name }}</span></h5>
              <ul>

                @foreach($products as $product)
                    <li>
                      <a href="/product/{{ $product->id }}">

                        @if($product->image != "empty")
                            <div class="product-image" style="background-image: url(https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/{{ $product->image }});"></div>
                        @else
                            <div class="logo"><img class="lips" src="/images/logo/logo-lips-black.svg"></div>
                        @endif

                        <span>{{ $product->name }}</span>
                      </a>
                    </li>
                @endforeach

              </ul>
            </div>

        </div>
      </div>
    </div>

@endsection