<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" href="/img/apple-icon-precomposed.png" type="image/x-icon" />
  <link rel="apple-touch-icon" href="/img/apple-icon-precomposed.png">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Musma Teknik 2024</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app" class="position-relative w-100 d-flex align-items-center justify-content-center"
    style="min-height: 100vh;overflow:hidden; background: black; padding:100px 0 60px 0px;">

    <div class="position-absolute bg-custom-red hidden">
      <img src="/img/logo-red.png" alt="Logo Teknik">
    </div>

    <main class="text-white glassmorph main-container" style="margin: 20px">
      @yield('content')
    </main>

    <a href="/" id="logoContainer" class=""
      style="position:fixed;left:50%; transform:translateX(-50%);top: 20px; z-index:9999;">
      <img width="120" src="img/logo-musma.png" alt="Ukiran">
    </a>

    <div class="position-absolute corner-bottom-left" style="rotate:45deg;">
      <img class="corner-img" src="img/ukiran.png" alt="Ukiran">
    </div>
    <div class="position-absolute corner-bottom-right" style="rotate:-45deg;">
      <img class="corner-img" src="img/ukiran.png" alt="Ukiran">
    </div>
    <div class="position-absolute corner-top-left" style="rotate:135deg;">
      <img class="corner-img" src="img/ukiran.png" alt="Ukiran">
    </div>
    <div class="position-absolute corner-top-right" style="rotate:-135deg;">
      <img class="corner-img" src="img/ukiran.png" alt="Ukiran">
    </div>
  </div>


  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
  <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
  <script>
    const logoContainer = document.getElementById('logoContainer');

    function handleScroll() {
      const scrolled = window.pageYOffset;

      if (scrolled > 5) {
        logoContainer.style.display = 'none';
      } else {
        logoContainer.style.display = 'block';
      }
    }

    window.addEventListener('scroll', handleScroll);
  </script>
</body>

</html>


<style>
  .glassmorph {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.125);
    border-radius: 0.5rem;
  }

  .main-container {
    padding: 3rem 2rem;
    border: #C90000 2px solid;
    max-height: max-content;
    position: relative;
    z-index: 6;
  }

  .bg-custom-red img {
    max-width: 100%;
    height: auto;
    opacity: 40%;
  }

  .corner-img {
    width: 200px;
  }

  .corner-bottom-left {
    left: -55px;
    bottom: -18px;
  }

  .corner-bottom-right {
    right: -55px;
    bottom: -18px;
  }

  .corner-top-left {
    left: -55px;
    top: -18px;
  }

  .corner-top-right {
    right: -55px;
    top: -18px;
  }

  @media screen and (max-width: 516px) {
    .main-container {
      border: none;
    }

    .bg-custom-red img {
      max-width: 300px;
      margin: auto auto;
      height: auto;
    }

    .corner-img {
      width: 100px;
    }

    .corner-bottom-left {
      left: -25px;
      bottom: -9px;
    }

    .corner-bottom-right {
      right: -25px;
      bottom: -9px;
    }

    .corner-top-left {
      left: -25px;
      top: -9px;
    }

    .corner-top-right {
      right: -25px;
      top: -9px;
    }
  }
</style>