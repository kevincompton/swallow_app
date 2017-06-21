@extends('layouts.client')

@section('content')

<div class="flex-container client-wrapper">
    <div class="dispensary-single">   
        <div class="dispensary-info">
            <h3>{{ $dispensary->name }}</h3>
            <div class="flex-container">
                <div class="left-column">
                    <img class="featured-image" src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/{{ $dispensary->logo }}">
                </div>
                <div class="right-column">
                    <div class="website">
                        <a href="{{ $dispensary->website }}" target="_blank">{{ $dispensary->website }}</a>
                    </div>
                    <div class="social-media"><strong>Instagram:</strong> {{ $dispensary->instagram }}</div>
                    <div class="contact-info">
                        <span><strong>Phone Number:</strong> {{ $dispensary->phone }}<br></span>
                        <span>
                            <strong>Address:</strong><br>
                            <span>{{ $dispensary->address }}<br></span>
                            <span>{{ $dispensary->city }}, </span>
                            <span>{{ $dispensary->state }}</span> <span>{{ $dispensary->zip }}</span>
                        </span>
                    </div>
                    <div class="description">
                        <strong>Dispensary Info: </strong>
                        <div>{{ $dispensary->description }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="inventory-products">
          <h5>Current inventory at <span>{{ $dispensary->name }}</span></h5>
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

@endsection