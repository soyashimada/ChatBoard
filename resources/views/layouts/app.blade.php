<!-- 2021/8/9 作成 -->
<!DOCTYPE html>
<html lang="ja" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- タイトル、説明文 -->
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

    <!-- ソーシャルメディア用 -->
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('base_url')">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS参照 -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5a46873167.js" crossorigin="anonymous"></script>
    
    <!-- フォント -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>
<body>
    <header class="mb-4">
        <nav class="navbar navbar-expand navbar-light bg-red-100 shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create_board') }}">create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search') }}">search</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="nav-img" src="{{ Auth::user()->user_image }}" alt="user_image" style="border-radius: 50%">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('board') }}">
                                    自分のボード
                                </a>
                                <a class="dropdown-item" href="{{ route('create_board') }}">
                                    ボード作成
                                </a>
                                <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">
                                    マイページ
                                </a>
                                <hr class="dropdown-divider" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
</header>

    <div class="content">
        <div class="main">
            @yield('content')
        </div>
    </div>

    <div class="footer">
        <div class="container-fluid border-top bg-dark" style="height: 40px">
            <div class="footer-content mr-4 mt-1">
                <p class="d-flex justify-content-end" style="color: white">copyright 2022 soya.</p>
            </div>
        </div>
    </div>
    <!-- Vueコンポーネントの読み込み -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>