<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Swallow.la</title>

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
          <a href="#">Edible Education</a>
          <a href="http://blog.swallow.la" target="_blank" routerLinkActive="active">Blog</a>
          <a href="#">Dispensaries</a>
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
            <a href="#">Edible Education</a>
            <a href="http://blog.swallow.la" target="_blank" routerLinkActive="active">Blog</a>
            <a href="#">Dispensaries</a>
          </nav>
        </div>
      </div>
    </header>

    
    @yield('content')

          

    <!-- Scripts -->
    <script src="{{ asset('js/client.js') }}"></script>
</body>
</html>
