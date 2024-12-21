<!DOCTYPE html>
<html>

<head>

  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? '' }}</title>

  <meta name="keywords" content="Musma Teknik 2024" />
  <meta name="description" content="Musma Teknik 2024">
  <meta name="SMFT" content="smft.unud.id/musma">

  <!-- Favicon -->
  <link rel="shortcut icon" href="/img/apple-icon-precomposed.png" type="image/x-icon" />
  <link rel="apple-touch-icon" href="/img/apple-icon-precomposed.png">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

  <!-- Web Fonts  -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400"
    rel="stylesheet" type="text/css">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="/vendor/line-awesome-1.3.0/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/vendor/animate/animate.min.css">
  <link rel="stylesheet" href="/vendor/simple-line-icons/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="/vendor/owl.carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="/vendor/owl.carousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="/vendor/magnific-popup/magnific-popup.min.css">



  <!-- Theme CSS -->
  <link rel="stylesheet" href="/css/theme.css">
  <link rel="stylesheet" href="/css/theme-elements.css">


  <!-- Current Page CSS -->
  <link rel="stylesheet" href="/vendor/rs-plugin/css/settings.css">
  <link rel="stylesheet" href="/vendor/rs-plugin/css/layers.css">
  <link rel="stylesheet" href="/vendor/rs-plugin/css/navigation.css">

  <!-- Demo CSS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <!-- Skin CSS -->
  <link rel="stylesheet" href="/css/skins/default.css"> {{-- ganti default dengan warna backgorund yang diinginkan --}}

  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href="/css/custom.css">

  <!-- Head Libs -->
  <script src="/vendor/modernizr/modernizr.min.js"></script>

</head>


<style>
  .candidate-box {
    display: flex;
    gap: 20px;
    flex-direction: row;
    justify-content: center;
  }

  @media screen and (max-width: 768px) {
    .candidate-box {
      display: flex;
      gap: 20px;
      flex-direction: column;
      justify-content: center;
    }
  }
</style>


<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay
  data-plugin-options="{'hideDelay': 100}">
  <div class="loading-overlay">
    <div class="bounce-loader">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>

  <body class="one-page" data-target="#header" data-spy="scroll" data-offset="100">

    <div class="body">
      @include('layouts/navigation')
      @yield('content')

      <footer id="footer" class="mt-0">
        <div class="footer-copyright">
          <div class="container py-2">
            <div class="row py-4">
              <div class="col d-flex align-items-center justify-content-center">
                <p><strong>MUSMA TEKNIK 2024</strong> - © Copyright 2024. All Rights Reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>

    <!-- Vendor -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="/vendor/popper/umd/popper.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/common/common.min.js"></script>
    <script src="/vendor/jquery.validation/jquery.validate.min.js"></script>
    <script src="/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="/vendor/vide/jquery.vide.min.js"></script>
    <script src="/vendor/vivus/vivus.min.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="/js/theme.js"></script>

    <!-- Current Page Vendor and Views -->
    <script src="/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/js/views/view.contact.js"></script>

    <!-- Theme Custom -->
    <script src="/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/js/custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="/js/theme.init.js"></script>

    <!-- Examples -->
    <script src="/js/examples/examples.portfolio.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>


    <script>
      $(document).ready(function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      });
    </script>

    @yield('footer')
  </body>

</html>
