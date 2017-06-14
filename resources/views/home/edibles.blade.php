@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            @include('partials._new_product')

            @foreach($links as $link)
                <div class="alert alert-info" role="alert">
                    <p>{{ $link->user }} would like to add your product {{ $link->product }} to their dispensary. <a href="/product/approve/{{ $link->user_id }}/{{ $link->product_id }}" class="btn btn-default">Approve</a> or <a href="#">cancel</a>.</p>
                </div>
            @endforeach

            <div class="panel panel-default">
                <div class="panel-heading">My Distributors</div>

                <div class="panel-body">

                    <ul>

                    @foreach($dispensaries as $dispensary)
                        <li>{{ $dispensary->company }}</li>
                    @endforeach

                    </ul>
                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">My Products</div>

                <div class="panel-body">
                    
                    <div class="row">
                    
                        @foreach($products as $product)
                        <div class="col-md-3">
                            <div class="product">
                                <img src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/wp-content/uploads/{{ $product->image }}" class="img-thumbnail" />
                                <h4>{{ $product->name }}</h4>
                                <small>Strength: {{ $product->strength }}</small>
                                <p>{{ $product->description }}</p>
                                <p>Ingredients: {{ $product->ingredients }}</p>

                                <a class="btn btn-default" href="/product/edit/{{ $product->id }}">Edit Product</a>
                                
                            </div>
                        </div>
                        @endforeach
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
