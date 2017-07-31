@extends('layouts.client')

@section('body_class', 'body__partners')

@section('content')

<div class="partners-container partner_dash">

    @include('partials._new_product')
    @include('partials._edit_company')

    <div class="row">
        <div class="col-md-12">

            @if(isset($user->company()->first()->name))
                <section class="company-info">
                    <h3>Company Information</h3>

                    <div class="panel-wrapper info-panels">
                        <div class="panel">
                            @if($user->company()->first()->address != null)
                                <h5>{{ $user->company()->first()->name }}</h5>
                                {{ $user->company()->first()->phone }}<br>
                                {{ $user->company()->first()->address }}<br>
                                {{ $user->company()->first()->city }}, {{ $user->company()->first()->state }} {{ $user->company()->first()->zip }}<br>
                                <a href="mailto:{{ $user->email }}" class="email_icon">{{ $user->email }}</a><br>
                                <a target="_blank" href="{{ $user->company()->first()->website }}" class="website_icon">{{ $user->company()->first()->website }}</a><br>
                                <a target="_blank" href="#" class="insta_icon">{{ $user->company()->first()->instagram }}</a>
                            @else 
                                <a href="#"><h5 class="info-cta">Add Company Information</h5></a>
                            @endif
                        </div>

                        <div class="panel">
                            <h5>Manage Account</h5>
                            <ul>
                                <li><a class="edit_company_trigger" href="javascript:void(0)">Edit Company Information</a></li>
                                <li><a class="add_product_trigger" href="#">Add Products</a></li>
                                <li><a href="#">Add Retail Location</a></li>
                            </ul>
                        </div>
                    </div>

                </section>
            @endif

            @foreach($links as $link)
                <div class="alert alert-info" role="alert">
                    <p>{{ $link->user }} would like to add your product {{ $link->product }} to their dispensary. <a href="/product/approve/{{ $link->user_id }}/{{ $link->product_id }}" class="btn btn-default">Approve</a> or <a href="#">cancel</a>.</p>
                </div>
            @endforeach

            <section class="products">
                <h3>My Products <small><a class="add_icon add_product_trigger" href="javascript:void(0)">Add Product</a></small></h3>

                <div class="panel-wrapper">
                    @foreach($products as $product)
                        <div class="panel">
                            <div class="product">
                                @if($product->image != "empty")
                                    <img src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/wp-content/uploads/{{ $product->image }}" class="img-thumbnail" />
                                @else 
                                    <h5><a href="#">Add Image</a></h5>
                                @endif
                                <h4>{{ $product->name }}</h4>
                                
                                <div class="details">
                                    @include('partials._edit_product')
                                </div>

                                <a class="btn btn-default edit_product_trigger" href="javascript:void(0)">Edit Product</a>
                                
                            </div>
                        </div>
                    @endforeach
                    <div class="panel add">
                        <div class="product">
                            <a class="add_icon add_product_trigger" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i><br> Add Product</a>
                        </div>
                    </div>
                </div>
                    
            </section>

            <section class="dispensaries">
                <h3>My Distributors</h3>

                <div class="panel-wrapper">

                    @foreach($dispensaries as $dispensary)
                        <div class="panel">{{ $dispensary->company }}</div>
                    @endforeach
                    <div class="panel add">
                        <div class="dispensary">
                            <a class="add_icon add_dispensary_trigger" href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i><br> Add Dispensary</a>
                        </div>
                    </div>
                    
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
