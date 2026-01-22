<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('homes') }}">
                <img src="{{ asset('images/cinema.png') }}" alt="Sigmaplex">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('homes') ? 'active' : '' }}"
                            href="{{ route('homes') }}">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movie') ? 'active' : '' }}"
                            href="{{ route('movie') }}">ภาพยนตร์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('movies.index') ? 'active' : '' }}"
                            href="{{ route('movies.index') }}">รีวิวภาพยนตร์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('promotions') ? 'active' : '' }}"
                            href="{{ route('promotions') }}">โปรโมชั่น</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}"
                            href="{{ route('news') }}">ข่าวสารและกิจกรรม</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link login" href="{{ route('login') }}">เข้าสู่ระบบ/สมัครสมาชิก</a>
                        </li>
                    @else
                        <li class="nav-item">
                            @if (Str::endsWith(Auth::user()->email, '@admin.com'))
                                <a class="nav-link login" href="{{ url('/HomeAdmin') }}">{{ Auth::user()->name }}</a>
                            @else
                                <a class="nav-link login" href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                            @endif
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>
