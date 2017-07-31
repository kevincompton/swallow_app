@extends('layouts.client')

@section('body_class', 'body__welcome')

@section('content')

@if(Cookie::get('age') == null)
  @include('partials._age-gate')
@endif

<div class="homepage-wrapper client-wrapper">
  <section class="hero">
    <div class="slide-bg" style="background-image: url(/images/redesign/photos/french-delicious-dessert-macaroons-PTQG8GV.jpg)"></div>
    <h1>Welcome To The World's Largest Edible Directory</h1>
    

      {!! Form::open(['url' => '/products/filter/', 'method' => 'GET']) !!}
        <div class="options">
            
            <div class="input-zip-code">
                <input class="form-control input-lg search" formControlName="search" name="search" type="text" placeholder="Search edible directory...">
                <button type="reset" class="filter">FILTERS <i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            <div id="home-dropdown" class="dropdown">

              @foreach($categories as $category)
                <div class="column">
                    <h4>{{ $category->title }} <i class="fa fa-angle-down" aria-hidden="true"></i></h4>
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

              <div class="clear"></div>
            </div>

        </div><!-- end options -->          
      {!! Form::close() !!}

      <h4>FEATURED ON</h4>
      <img class="feature-logo" src="/images/redesign/featured-high-times.png" />
      <img class="feature-logo" src="/images/redesign/featured-viceland.png" />
      <img class="feature-logo" src="/images/redesign/featured-vice.png" />

      <div style="clear:both;"></div>

      <i class="fa fa-angle-down" aria-hidden="true"></i>

  </section>

  <section class="featured-articles">
    <article class="blog-post" style="background-image: url(/images/redesign/photos/cookie-sandwiches-PFMYYA6.jpg)">
      <h4>KIVA CONFECTIONS</h4>
      <h2>Alice Moon favorite for years!</h2>
      <button class="btn">READ MORE ABOUT KIVA</button>
    </article>
    <article class="blog-post" style="background-image: url(/images/redesign/photos/cookie-sandwiches-PFMYYA6.jpg)">
      <h4>PLASTIC PALMTREE</h4>
      <h2>High end cannabis business branding</h2>
      <button class="btn">VISIT PLASTICPALMTREE</button>
    </article>
    <div class="clear"></div>
  </section>

  <section class="education">
    <h1>What is an edible?</h1>
    <p>Edibles are foods infused with cannabis or cannabis oils. Edibles come in a variety of forms including drinks, brownies, candies, cookies & more.</p>
    <h4>TYPES OF EDIBLES</h4>
    <ul>
      <li class="baked"><img src="/images/redesign/icon-cupcake.png" />Baked Goods</li>
      <li class="drinks"><img src="/images/redesign/icon-drinks.png" />Drinks</li>
      <li class="snacks"><img src="/images/redesign/icon-savory-snacks.png" />Savory Snacks</li>
      <li class="candy"><img src="/images/redesign/icon-candy.png" />Candy</li>
      <li class="tinctures"><img src="/images/redesign/icon-tinctures.png" />Tinctures</li>
    </ul>
  </section>

  <section class="about">
    <img src="/images/redesign/photos/cookie-sandwiches-PFMYYA6.jpg" />
    <h1>Why Edibles?</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
    <br>
    <a class="btn">LEARN ABOUT EDIBLES</a>
    <div class="clear"></div>
  </section>

  <section class="news">
    <h1>Latest News</h1>
    <article style="background-image: url(/images/redesign/photos/kivablueberries3.jpg)">
      <h3>Kiva Terra Blueberries</h3>
      <p>Kiva milk chocolate covered blueberries are soooo tasty!</p>
      <a href="https://blog.swallow.la/2017/07/16/kiva-terra-blueberries/" target="_blank" class="btn">READ MORE</a>
    </article>
    <article style="background-image: url(/images/redesign/photos/fullsizerender.jpg)">
      <h3>The edible to avoid</h3>
      <p>I came across EndoHack Labs at the 4.20 Games...</p>
      <a href="https://blog.swallow.la/2017/04/09/the-edible-to-avoid-if-you-use-cannabis-as-a-medicine/" target="_blank" class="btn">READ MORE</a>
    </article>
    <article style="background-image: url(/images/redesign/photos/cannacurebalm.jpg)">
      <h3>Cannacure Ultrabalm</h3>
      <p>I first tried out this product when I was..</p>
      <a href="https://blog.swallow.la/2017/02/22/cannacure-pain-relieving-ultrabalm/" target="_blank" class="btn">READ MORE</a>
    </article>
    <a class="btn">VIEW ARCHIVES</a>
    <div class="clear"></div>
  </section>

</div>
@endsection