@extends('layouts.teknik')

@section('content')
  <div>
    <h1 style="text-align:center; text-transform:uppercase;font-weight:700;">Login</h1>
    <div class="form-custom-layout">
      <form action="/login" method="POST" class="form-custom">
        @csrf
        <div class="form-group-custom">
          <input type="text" class="@error('nim') error @enderror" name="nim" id="nim"
            value="{{ old('nim') }}" placeholder="Masukan NIM" maxlength="10" required>
          @error('nim')
            <p class="message-error">
              {{ $message }}
            </p>
          @enderror
        </div>
        <div class="form-group-custom">
          <input type="password" name="password" class="@error('password') error @enderror" id="password"
            placeholder="Masukan Password" required>
          @error('password')
            <p class="message-error">
              {{ $message }}
            </p>
          @enderror
        </div>
        <button class="btn-custom">Masuk</button>
      </form>
      <span style="display:block;text-align:center;">Belum terdaftar?
        <a href="/register" style="color:#E54C4C;text-decoration:underline;">Daftar sekarang</a>
      </span>
    </div>
  </div>
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
  <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
  <script src="/js/app.js"></script>
  <script src="/js/auth.js"></script>

  <script>
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

    $("#nim").inputFilter(function(value) {
      return /^-?\d*$/.test(value);
    });
  </script>
@endsection

<style>
  .form-custom-layout {
    width: 450px;
  }

  .form-custom {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
  }

  .form-custom .form-group-custom {
    display: flex;
    flex-direction: column;
  }

  .form-custom .form-group-custom label {
    margin-bottom: 2px;
  }

  .form-custom .form-group-custom input {
    padding: 10px;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.125);
    color: white;
    border: none;
  }

  .form-custom .form-group-custom input.error {
    border: 1px solid #EE7575;
  }

  .message-error {
    color: #EE7575;
    font-size: 12px;
    margin-top: 2px;
    margin-bottom: 0;
  }

  .form-custom .form-group-custom input:focus {
    outline: none;
  }

  .form-custom .btn-custom {
    margin-top: 15px;
    padding: 10px;
    font-weight: bold;
    border-radius: 5px;
    background-color: #810000;
    color: white;
    border: none;
    transition: all 0.35s ease;
  }

  .form-custom .btn-custom:hover {
    background-color: #C90000;
    cursor: pointer;
  }


  @media screen and (max-width: 516px) {
    .form-custom-layout {
      width: 100%;
    }

  }
</style>
