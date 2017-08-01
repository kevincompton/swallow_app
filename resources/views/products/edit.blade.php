@extends('layouts.client')

@section('body_class', 'body__partners')

@section('content')
<div class="partners-container">

    <ol class="breadcrumb">
        <li><a href="/home">Dashboard</a></li>
        <li>/</li>
        <li class="active">Edit {{ $product->name }}</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <h3>Edit {{ $product->name }}</h3>

                <div class="panel-body">
                    {!! Form::open(['url' => '/product/update/' . $product->id, 'files' => true, 'method' => 'PUT']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="{{ $product->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="strength">Product Strength</label>
                                    <input name="strength" type="text" class="form-control" id="strength" value="{{ $product->strength }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Product Ingredients</label>
                                    <textarea class="form-control" name="ingredients" id="ingredients" rows="3">{{ $product->ingredients }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <img src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/{{ $product->image }}" class="img-thumbnail" />
                                    <input type="file" id="image" name="image">
                                    <p class="help-block">Update your image.</p>
                                </div>  
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Update Product</button>
                    {!! Form::close() !!}
                    <a class="btn btn-warning" href="/product/deactivate/{{ $product->id }}">Deactivate Product</a>
                    <a href="/product/delete/{{ $product->id }}">Delete Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
