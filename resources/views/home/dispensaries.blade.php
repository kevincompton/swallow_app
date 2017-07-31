@extends('layouts.client')

@section('body_class', 'body__partners')

@section('content')
<div class="partners-container container" id="autocomplete">
    <div class="row">
        <div class="col-md-12">

            <h2>Company Information</h2>

            <div class="panel panel-default">
                <div class="panel-heading">My Products</div>

                <div class="panel-body">
                    
                    <div class="row">
                    
                        <div v-for="product in user_products" v-if="product.id > 0" class="col-md-3">
                            <div class="product">
                                <img :src="product.image" class="img-thumbnail" />
                                <h4>@{{ product.name }}</h4>
                                <small>Strength: @{{ product.strength }}</small>
                                <p>@{{ product.desc }}</p>
                                <p>Ingredients: @{{ product.ingredients }}</p>

                                <a class="btn btn-danger" :href="product.detach">Remove Product</a>
                            </div>
                        </div>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
