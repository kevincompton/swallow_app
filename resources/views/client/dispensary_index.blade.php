@extends('layouts.client')

@section('content')
  <div class="flex-container client-wrapper">
    <div class="dispensary-wrapper">
      <div class="dispensary-locator">

        <div class="left-content">
          
          <form>
            <input id="searchTextField" type="text" formControlName="address" placeholder="Enter your address">
            <button type="submit" name="subscribe">SEARCH</button>
          </form>
          
          <ul>
            
            @foreach($dispensaries as $dispensary)
              <li>
                <a href="#">
                  <h5>{{ $dispensary->name }}</h5>
                  {{ $dispensary->address }}<br>
                  {{ $dispensary->city }}, {{ $dispensary->state }} {{ $dispensary->zip }}
                  <span class="distance"></span>
                </a>
              </li>
            @endforeach

          </ul>

        </div>

        <div class="right-content">

        </div>
        
      </div>
    </div>
  </div>
@endsection