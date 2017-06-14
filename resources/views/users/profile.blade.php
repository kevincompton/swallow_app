@extends('layouts.app')

@section('content')
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/home">Dashboard</a></li>
        <li class="active">Edit {{ $user->company }}</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $user->company }}</div>

                <div class="panel-body">
                    {!! Form::open(['url' => '/user/update/', 'method' => 'PUT']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company Name</label>
                                    <input name="company" type="text" class="form-control" id="company" value="{{ $user->company }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Company Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option @if($user->category == "dispensary") selected @endif value="dispensary">Dispensary</option>
                                        <option @if($user->category == "edibles") selected @endif value="edibles">Edibles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="text" class="form-control" id="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Update Profile</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
