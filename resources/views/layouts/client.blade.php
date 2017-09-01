<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Swallow.la</title>

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway" rel="stylesheet">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://use.fontawesome.com/e6f27715c0.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
</head>
<body class="@yield('body_class')">

    <header id="client-header">
      <div class="header container">

        <ul class="tools">
          <li>FOLLOW US</li>
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <li class="spacer">|</li>
          @if (Auth::guest())
            <li><a href="/register">SIGN IN / SIGNUP</a></li>
          @else
            <li><a href="/home">{{ Auth::user()->name }}</a> / <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </li>
          @endif
        </ul>

        <a class="logo" href="/">
          <img class="lips" src="/images/logo/logo-header.png">
        </a>

        <nav class="desktop-menu">
          <a href="/education">Education</a>
          <a href="/edibles">Directory</a>
          <a href="/dispensaries">Dispensaries</a>
          <a href="http://blog.swallow.la" target="_blank">News & Reviews</a>     
        </nav>

        <div class="mobile-menu">
          <a class="menu-button">
            <div class="menu-icon">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
          </a>

          <nav class="mobile-nav">
            <a href="/">Home</a>
            <a href="/edibles">Edible Directory</a>
            <a href="/education">Edible Education</a>
            <a href="http://blog.swallow.la" target="_blank" routerLinkActive="active">Blog</a>
            <a href="/dispensaries">Dispensaries</a>
          </nav>
        </div>
      </div>
    </header>

    @yield('content')

    <section class="partners">
      <div style="background-image: url(/images/redesign/photos/french-delicious-dessert-macaroons-PTQG8GV.jpg)">
        <h2>List your edible in Swallow's directory</h2>
        <a href="/register?category=edibles" class="btn">ADD YOUR EDIBLES</a>
      </div>
      <div style="background-image: url(/images/redesign/photos/french-delicious-dessert-macaroons-PTQG8GV.jpg)">
        <h2>Add your dispensary to our directory</h2>
        <a href="/register?category=dispensary" class="btn">ADD YOUR DISPENSARY</a>
      </div>
      <hr class="clear">
    </section>

    <nav class="footer-primary">
      <ul>
        <li>Who Are We</li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Education</a></li>
        <li><a href="/register?category=edibles">Submit Edible</a></li>
        <li><a href="/register?category=dispensary">Submit Dispensary</a></li>
        <li><a href="http://blog.swallow.la" target="_blank">News & Reviews</a></li>
      </ul>
      <ul>
        <li>Categories</li>
        <li><a href="#">Dietary</a></li>
        <li><a href="#">Breeds</a></li>
        <li><a href="#">Types</a></li>
        <li><a href="#">Dispensaries</a></li>
      </ul>
      <ul>
        <li>Follow Us</li>
        <li><a href="https://www.facebook.com/worldslargestedibledirectory" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="https://twitter.com/swallowla" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="https://www.instagram.com/swallow.la/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
      </ul>

      <hr class="clear">
    </nav>

    <div class="footer container">
      <div class="row">
        <nav class="footer-nav">
          <a href="/files/Swallow_Privacy-Policy_2016.pdf" target="_blank">Terms &amp; Conditions</a>
          <a href="/files/Swallow_Terms-of-Service_2016.pdf" target="_blank">Privacy Policy</a>
        </nav>
      </div>

      <div class="row">
        <div class="copyright">
          ©2017 Swallow. All Rights Reserved.
        </div>
      </div>
    </div>   

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/client.js') }}"></script>
</body>
</html>
