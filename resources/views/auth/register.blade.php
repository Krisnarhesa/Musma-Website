@extends('layouts.teknik')

@section('content')
    @php
        $currentDate = now()->format('Y-m-d H:i:s');
        $startDate = date('Y-m-d', strtotime('2025-01-03'));
        $voteDate = date('Y-m-d', strtotime('2025-01-10'));
    @endphp
    <div>
        @if ($currentDate < $startDate)
            <h5>Masa pendaftaran belum dimulai. Silahkan kembali pada <a
                    style="color:#E54C4C;text-decoration:underline;">tanggal 3 sampai 9 Januari 2025</a> untuk melakukan
                registrasi.</h5>
        @elseif ($currentDate >= $startDate && $currentDate < $voteDate)
            <h1 style="text-align:center;font-weight:700;">REGISTER</h1>

            <div class="form-custom-layout">
                <form action="/register" method="POST" enctype="multipart/form-data" class="form-custom">
                    @csrf
                    <div class="form-group-custom-inline">
                        <div class="form-group-custom">
                            <input type="text" name="register_nim" id="nim" placeholder="Masukkan NIM"
                                maxlength="10" class="@error('register_nim') error @enderror"
                                value="{{ old('register_nim') }}">
                            @error('register_nim')
                                <p class="message-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group-custom">
                            <input type="text" name="nama" id="nama" placeholder="Mahasiswa Berdasarkan NIM"
                                disabled value="{{ old('nama_hidden') }}" class="@error('nama_hidden') error @enderror"
                                style="cursor: not-allowed">
                            <input type="hidden" name="nama_hidden" id="nama_hidden" value="{{ old('nama_hidden') }}">
                            @error('nama_hidden')
                                <p class="message-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group-custom-inline">
                        <div class="form-group-custom">
                            <input type="password" name="register_password" id="pwdId" placeholder="Masukkan Password"
                                class="@error('register_password') error @enderror" pattern="^[0-9a-zA-Z]{2,30}$" required>
                            @error('register_password')
                                <p class="message-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="form-group-custom">
                            <input type="password" name="password_confirmation" id="cPwdId"
                                class="myCpwdClass @error('password_confirmation') error @enderror"
                                placeholder="Konfirmasi Password" pattern="^[0-9a-zA-Z]{2,30}$" required>
                            @error('password_confirmation')
                                <p class="message-error">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label>Scan KTM/KRM/UKT Ku</label>
                        <input placeholder="Masukan Foto" class=" @error('file_url') is-invalid @enderror input-file-custom"
                            name="file_url" type="file" id="customFile" accept="image/*" required
                            value="{{ old('file_url') }}" <small class="maks-size-file ">*maks file 2Mb</small>
                        @error('file_url')
                            <p class="message-error">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button class="btn-custom">Daftar</button>
                </form>
                <span style="display:block;text-align:center;">Sudah terdaftar?
                    <a href="/login" style="color:#E54C4C;text-decoration:underline;">Login sekarang</a>
                </span>
            </div>
        @else
            <h5>Masa pendaftaran telah berakhir. Silahkan <a href="/login"
                    style="color:#E54C4C;text-decoration:underline;">login</a> untuk melakukan polling.</h5>
        @endif

    </div>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/auth.js"></script>

    <script>
        $(document).ready(function() {
            $('#nim').on('input', function() {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete.fetch') }}",
                        method: "POST",
                        data: {
                            query: query,
                            _token: _token
                        },
                        success: function(data) {
                            $('#nama').val(data);
                            $('#nama_hidden').val(data);
                        }
                    });
                }
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

        $("#nim").inputFilter(function(value) {
            return /^-?\d*$/.test(value);
        });
    </script>
@endsection

<style>
    .form-custom-layout {
        width: 550px;
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

    .form-custom .form-group-custom-inline {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 100%;
        gap: 20px;
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

    .input-file-custom::-webkit-file-upload-button {
        visibility: hidden;
    }

    .input-file-custom::before {
        content: 'Upload Dokumen';
        display: inline-block;
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        font-weight: 700;
        font-size: 10pt;
    }

    .input-file-custom:hover::before {
        border-color: black;
    }

    @media screen and (max-width: 516px) {
        .form-custom-layout {
            width: 100%;
        }

        .form-custom .form-group-custom-inline {
            display: flex;
            flex-direction: column;
        }

    }
</style>
