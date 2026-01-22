<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <title>Log in success</title>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2>ยินดีต้อนรับสู่ Sigmaplex</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <p>{{ __('ขอให้คุณ :name เพลิดเพลินกับการชมภาพยนตร์', ['name' => Auth::user()->name]) }}</p>
        <div class="button-container">
            <a href="{{ route('homes') }}" class="btn-home">ไปสู่หน้าหลัก</a><br>
        
            <a href="{{ route('logout') }}"
               class="btn-logout"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        
    </div>
</div>

</body>
</html>