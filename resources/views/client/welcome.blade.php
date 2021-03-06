@extends('layouts.client')

@section('body_class', 'body__welcome')

@section('content')

@if(Cookie::get('age') == null)
  @include('partials._age-gate')
@endif

<div class="homepage-wrapper client-wrapper">
  <section class="hero">
    <div class="slide-bg" style="background-image: url(/images/redesign/photos/hero.jpg)"></div>
    <h1>Welcome To The World's Largest Edible Directory</h1>
    

      {!! Form::open(['url' => '/products/filter/', 'method' => 'GET']) !!}
        <div class="options">
            
            <div class="input-zip-code">
                <input class="form-control input-lg search" formControlName="search" name="search" type="text" placeholder="Search or select filters...">
                <button type="button" class="filter"><span>FILTERS</span> <i class="fa fa-angle-down" aria-hidden="true"></i></button>
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
    <article class="blog-post" style="background-image: url(/images/redesign/photos/levo.jpg)">
      <h4>LEVO OIL</h4>
      <h2>Use code Swallow for $15 off!</h2>
      <a href="https://www.levooil.com/" target="_blank" class="btn">VISIT LEVO</a>
    </article>
    <article class="blog-post" style="background-image: url(/images/plastic_palmtree.jpg)">
      <h4>PLASTIC PALMTREE</h4>
      <h2>High end cannabis business branding</h2>
      <a target="_blank" href="http://www.plasticpalmtree.net/emerald/" class="btn">VISIT PLASTICPALMTREE</a>
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
    <p>Edibles are discrete, delicious, reasonably priced, and effective. Edibles are perfect for those moments when you want to be medicated but can't smoke.</p>
    <br>
    <a href="/education" class="btn">LEARN ABOUT EDIBLES</a>
    <div class="clear"></div>
  </section>

  <section class="news">
    <h1>Latest News</h1>
    <article style="background-image: url(/images/products/fruit-farm.jpg)">
      <h3>Hello Fruit Farm Pineapple Loud</h3>
      <p>These dried pineapple slices have a delicious sweetness to them.</p>
      <a href="https://blog.swallow.la/2017/07/16/kiva-terra-blueberries/" target="_blank" class="btn">READ MORE</a>
    </article>
    <article style="background-image: url(/images/products/mbox.jpg)">
      <h3>Unboxing MBOX</h3>
      <p>My guest Jesushands and I unboxed M Box Volume 16...</p>
      <a href="https://blog.swallow.la/2017/04/09/the-edible-to-avoid-if-you-use-cannabis-as-a-medicine/" target="_blank" class="btn">READ MORE</a>
    </article>
    <article style="background-image: url(/images/redesign/photos/cannacurebalm.jpg)">
      <h3>Cannacure Ultrabalm</h3>
      <p>I first tried out this product when I was..</p>
      <a href="https://blog.swallow.la/2017/02/22/cannacure-pain-relieving-ultrabalm/" target="_blank" class="btn">READ MORE</a>
    </article>
    <a class="btn" href="http://blog.swallow.la" target="_blank">VIEW ARCHIVES</a>
    <div class="clear"></div>
  </section>

</div>
@endsection