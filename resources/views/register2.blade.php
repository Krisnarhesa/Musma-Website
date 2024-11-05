<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <!-- Vendor CSS -->
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="/vendor/line-awesome-1.3.0/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
  <title>Sign in & Sign up Form</title>
</head>

<body>
  @php
   $isRegis = Route::has('register');
  $isSignUp = '';
  if(Route::currentRouteName() == 'register'){
  $isSignUp = 'sign-up-mode';
  }

  if(session('is-sign-up')){
  $isSignUp = session('is-sign-up');
  }
  @endphp
@if(!$isRegis)
<style>
  @media (max-width: 870px) {
    .containers {
        min-height: 800px;
        height: 100vh;
        transform: translate(0%, -10%);
      }
    }
  </style>
  @endif
  <div class="containers {{ $isSignUp?? '' }}">
    <div class="signin-signup">
      <form method="POST" action="{{ route('login') }}" class="sign-in-form">
        @csrf

        <h2 class="title">Sign in</h2>
        <div class="row">
          <div class="input-field col-md-12">
            <label>Nim</label>
            <div class="pom-agile">
              <span class="fa fa-user"></span>
              <input placeholder="Nim" type="text" class=" @error('nim') is-invalid @enderror" name="nim" id="nim2"
                required="">
            </div>
            @error('nim')
            <p class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </p>
            @enderror
          </div>
          <div class="input-field col-md-12">
            <label>Password</label>
            <div class="pom-agile">
              <span class="fa fa-lock"></span>
              <input placeholder="password" class=" @error('password') is-invalid @enderror" name="password"
                type="password" required="">
            </div>
            @error('password')
            <p class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </p>
            @enderror
          </div>
        </div>
        <input type="submit" value="Login" class="bton" />
        @if(!$isRegis)
        <p class="d-block d-lg-none d-md-none text-center"> Masa Registrasi Telah Berakhir. Silahkan Login dengan form di atas!
        </p>
        @else
        <p class="d-block d-lg-none d-md-none text-center"> belum memiliki akun? silahkan daftar
          <a id="sign-up-btpn">disini</a>
        </p>
        @endif
      </form>
      @if($isRegis)
      <form method="POST" action="{{ route('register.create') }} " class="sign-up-form" enctype="multipart/form-data"
        id="myForm1" autocomplete="off">
        @csrf
        <h2 class="title">Sign Up</h2>
        <div class="row">
          <div class="input-field col-md-12">
            <label>Nim</label>
            <div class="pom-agile">
              <span class="fa fa-user"></span>
              <input placeholder="Nim" name="register_nim" id="nim" type="text" required="">
            </div>
            @error('register_nim')
            <p class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </p>
            @enderror
            <div id="nimList"></div>
          </div>
          <div class="input-field col-lg-6 col-md-12">
            <label>Password</label>
            <div class="pom-agile">
              <span class="fa fa-key"></span>
              <input type="password" name="register_password" placeholder="Pasword" id="pwdId" class="form"
                pattern="^[0-9a-zA-Z]{2,30}$" required>
            </div>
            @error('register_password')
            <p class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </p>
            @enderror
            <div class="valid-feedback" style="position:relative;bottom:10px;" id=pwdValid>Valid</div>
            <div class="invalid-feedback " style="position:relative;bottom:10px;" id=pwdInValid>(min 2 to 30 max)</div>
          </div>
          <div class="input-field col-lg-6 col-md-12">
            <label>Confirm Password</label>
            <div class="pom-agile">
              <span class="fa fa-key"></span>
              <input type="password" name="password_confirmation" placeholder="Confirm Password" id="cPwdId"
                class="form myCpwdClass" pattern="^[0-9a-zA-Z]{2,30}$" required>
            </div>
            <div class="alert-pass">
              <div id="cPwdValid" class="valid-feedback" style="position:relative;bottom:10px;">Passwords Match</div>
              <div id="cPwdInvalid" class="invalid-feedback " style="position:relative;bottom:10px;">a to z only (2 to 6
                long)</div>
            </div>
          </div>

          <div class="form-style-agile col-md-12 pb-2">
            <label>Scan KTM/KRM/UKT Ku</label>
            <div class="pom-agile">
              <label class="text-left font-" for="customFile" id="custom-File" style="line-height: 2">Choose
                file</label>
              <input placeholder="Masukan Foto" class=" @error('file_url') is-invalid @enderror" name="file_url"
                type="file" id="customFile" required>
              <span class="fa fa-folder" style="line-height: 2"></span>
            </div>
            <small class="maks-size-file text-danger mb-5">*maks file 2Mb</small>
            @error('file_url')
            <p class="text-danger" role="alert">
              <strong>{{$message}}</strong>
            </p>
            @enderror
          </div>
        </div>
        <input type="submit" value="Submit" id="submitBtn" class="bton justify-content-center gx-auto">
        <p class="d-block d-lg-none d-md-none text-center"> sudah memiliki akun? silahkan sign-in
          <a id="sign-in-btpn" onclick="{{ session(['is-sign-up' => '']) }}">disini</a>
        </p>
      </form>
      @endif
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          @if(!$isRegis)
          <h3>LOGIN</h3>
          <p>
            Masa Registrasi Telah Berakhir. Silahkan Melakukan Login Melalui Form Di Bawah Ini!
          </p>
          @else
          <h3>Belum Meiliki Akun ?</h3>
          <p>
            Silahkan Daftar Terlebih Dahulu Melalui Tombol Di Bawah Ini
          </p>
          <button class="bton transparent" id="sign-up-bton">
            Sign up
          </button>
          @endif
        </div>
        <img src="/img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Sudah Memiliki Akun ?</h3>
          <p>
            Silahkan Melakukan Sign In Melalui Tombol Di Bawah Ini
          </p>
          <button class="bton transparent" id="sign-in-bton">
            Sign in
          </button>
        </div>
        <img src="/img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
  <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
  <script src="/js/app.js"></script>
  <script src="/js/auth.js"></script>

  <script>
    $(document).ready(function(){

      $('#nim').keyup(function(){
        var query = $(this).val();
        if(query != ''){
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url:"{{ route('autocomplete.fetch') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
              $('#nimList').fadeIn();
              $('#nimList').html(data);
            }
          });
        }
      });

      $(document).on('click', 'li', function(){
        $('#nim').val($(this).text().replace(/[^0-9\.]/g, ''));
        $('#nimList').fadeOut();
      });

    });

    (function($) {
      $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      };
    }(jQuery));

  // Install input filters.
  $("#nim").inputFilter(function(value) {
    return /^-?\d*$/.test(value);
  });
    $("#nim2").inputFilter(function(value) {
    return /^-?\d*$/.test(value);
  });
  </script>
</body>

</html>
