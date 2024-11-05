@auth
@php
$user = Auth::user();
$user_role = $user->getRoleNames()[0];
@endphp
@endauth
<header id="header" class="header-transparent header-effect-shrink"
    data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 80}">

    <div class="header-body border-top-0 bg-dark box-shadow-none">
        <div class="header-container container">

            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="/">
                                <img alt="Musma" width="160" height="70" src="img/logo-musma.png">

                            </a>
                        </div>
                    </div>
                </div>

                <div class="header-column justify-content-end">
                    <div class="header-row">

                        <div
                            class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
                            <div
                                class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                @if($title == 'Rekapitulasi')
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        @auth
                                        {{-- logined --}}
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle d-lg-none border-all" href="#">
                                                {{ Auth::user()->nim }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                @if ($user->hasRole('admin') || $user->hasRole('sekre'))
                                                <li>
                                                    <a class="dropdown-item" href="/admin">
                                                        Admin
                                                    </a>
                                                </li>
                                                @endif
                                                @if (Route::has('logout'))
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                                        Logout
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endauth

                                        @guest
                                        <li class="d-block d-lg-none py-2">
                                            <a href="@if (Route::has('register')) {{route('register')}} @else
                                                # @endif" class="text-light"> Daftar</a> <span
                                                class="text-light"> / </span> <a href="@if (Route::has('auth'))
                                                {{route('auth')}} @else # @endif"
                                                class="text-light">Login</a>
                                        </li>
                                        @endguest
                                        <li>
                                            <a class="dropdown-item active" href="/">
                                                Home
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" data-hash data-hash-offset="75"
                                                href="#smft">SMFT</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" data-hash data-hash-offset="75"
                                                href="#bpmft">BPMFT</a>
                                        </li>
                                    </ul>
                                </nav>
                                @else
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        @auth
                                        {{-- logined --}}
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle d-lg-none border-all" href="#">
                                                {{ Auth::user()->nim }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                @if ($user->hasRole('admin') || $user->hasRole('sekre'))
                                                <li>
                                                    <a class="dropdown-item" href="/admin">
                                                        Admin
                                                    </a>
                                                </li>
                                                @endif
                                                @if (Route::has('logout'))
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                                        Logout
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </li>
                                        @endauth

                                        @guest
                                        <li class="d-block d-lg-none py-3">
                                            <a href="@if (Route::has('register')) {{route('register')}} @else
                                                # @endif" class="text-light"> Daftar</a> <span
                                                class="text-light"> / </span> <a href="@if (Route::has('auth'))
                                                {{route('auth')}} @else # @endif"
                                                class="text-light">Login</a>
                                        </li>
                                        @endguest
                                        <li>
                                            <a data-hash class="dropdown-item py-3 active" href="#home">
                                                Home
                                            </a>
                                        </li>
                                        @if (Route::has('rekap'))
                                        <li>
                                            <a class="dropdown-item py-3 active" href="{{ route('rekap') }}">
                                                Rekapitulasi
                                            </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item py-3" data-hash data-hash-offset="68"
                                                href="#tentang">tentang</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-3" data-hash data-hash-offset="68"
                                                href="#Polling">Polling</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-3" data-hash data-hash-offset="68"
                                                href="#contact">Contact Us</a>
                                        </li>
                                    </ul>
                                </nav>
                                @endif
                            </div>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>

                        </div>
                    </div>

                </div>

            </div>

            <nav class="header-nav-top p-1 d-none d-lg-inline-flex">
                <ul class="nav nav-pills">
                    @guest
                    <li class="nav-item dropdown nav-item-left-border  border-black">
                        <div class="border p-2 nav-link" role="button" id="dropdownLanguage" aria-haspopup="true"
                            aria-expanded="false">
                            <a href="@if (Route::has('register')) {{route('register')}} @else
                                # @endif" class="text-light"> Daftar</a> <span
                                class="text-light">
                                /
                            </span> <a href="@if (Route::has('auth')) {{route('auth')}} @else
                                # @endif" class="text-light">Login</a>
                        </div>
                    </li>
                    @endguest
                    @auth
                    {{-- logined --}}
                    <li class="nav-item dropdown nav-item-left-border">
                        <a class="nav-link" href="#" role="button" id="dropdownLanguage" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->nim }}
                            <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu" style="background-color:#212529!important;">
                            @if ($user->hasRole('admin') || $user->hasRole('sekre'))
                            <a class="dropdown-item" href="/admin">
                                Admin
                            </a>
                            @endif

                            @if (Route::has('logout'))
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            @endif
                        </div>
                    </li>
                    @endauth
                </ul>
            </nav>


        </div>

    </div>

</header>