@extends('layouts.client')

@section('content')
<div class="homepage-wrapper client-wrapper">
  <section class="hero">
    <div class="slide-bg" style="background-image: url(https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-688454114864/wp-content/uploads/2016/09/27005018/homepage-hero.jpg)"></div>
    <h2>Welcome To The World's Largest Edible Directory</h2>
    
    <div class="filter-container">
      <h3><hr><span>Select from the preferences below to<br>find the right edible for you</span><hr></h3>
      {!! Form::open(['url' => '/products/filter/', 'method' => 'POST']) !!}
          <div class="options">
              <div class="flex-container">

                @foreach($categories as $category)
                  <div class="column">
                      <h4>{{ $category->title }}</h4>
                      <ul>

                        @foreach($category->tags()->get() as $tag)
                          <li>
                              <label>
                                  <input type="checkbox" name="tag_{{ $tag->id }}" value="{{ $tag->id }}">
                                  {{ $tag->title }}
                              </label>
                          </li>
                        @endforeach

                      </ul> 
                  </div>
                @endforeach

              </div>
              <div class="input-zip-code" >
                  <input class="form-control input-lg search" formControlName="search" name="search" type="text" placeholder="Search edible directory...">
              </div>
          </div><!-- end options -->
          
          <button type="submit">Search</button>
      {!! Form::close() !!}
    </div>
  </section>
</div>
@endsection