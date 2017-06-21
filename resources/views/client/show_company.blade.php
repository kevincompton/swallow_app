@extends('layouts.client')

@section('content')

    <div class="flex-container client-wrapper">
      <div class="company-single">   
        <div>

            <div class="company-info">
                <h3>{{ $company->name }}</h3>
                <div class="flex-container">
                    <div class="left-column">
                        <img class="featured-image">
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

        </div>
      </div>
    </div>

@endsection