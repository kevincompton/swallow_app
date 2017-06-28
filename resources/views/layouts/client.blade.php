<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Swallow.la</title>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Styles -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
</head>
<body>

    <header id="client-header">
      <div class="header container">
        <a class="logo" href="/">
          <img class="lips" src="/images/logo/logo-lips-black.svg">
          <div class="words">
            <img class="text" src="/images/logo/logo-text.svg">
            <span class="beta">BETA</span>
          </div>
        </a>

        <nav class="desktop-menu">
          <a href="/edibles">Edible Directory</a>
          <a href="/education">Edible Education</a>
          <a href="http://blog.swallow.la" target="_blank" routerLinkActive="active">Blog</a>
          <a href="/dispensaries">Dispensaries</a>
        </nav>

        <div class="mobile-menu">
          <a class="menu-button">
            <div class="menu-icon">
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
        <nav class="social-nav">
          <a href="https://www.facebook.com/worldslargestedibledirectory" target="_blank"><img src="/images/icons/facebook-icon.svg"></a>
          <a href="https://twitter.com/swallowla" target="_blank"><img src="/images/icons/twitter-icon.svg"></a>
          <a href="https://www.instagram.com/swallow.la/" target="_blank"><img src="/images/icons/instagram-icon.svg"></a>
        </nav>
      </div>
    </div>   

    <!-- Scripts -->
    <script src="{{ asset('js/client.js') }}"></script>
</body>
</html>
