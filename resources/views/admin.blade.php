@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Unapproved Users</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Category</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($pending_users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->company }}</td>
                                <td>{{ $user->category }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="approve/{{ $user->id }}">Approve</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Users</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Category</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->company }}</td>
                                <td>{{ $user->category }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Companies</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Website</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->category }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>{{ $company->website }}</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
