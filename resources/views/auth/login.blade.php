<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>
    <div class="container">
        <div class="form-container">

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <img src="{{ asset('cinema.png') }}" alt="Cinema Logo" class="aaa" style="width: 150px;">
            <h4>Login into your account</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input id="email" type="email" name="email" placeholder="Email Address" required>
                <input id="password" type="password" name="password" placeholder="Password" required>
                <button type="submit">{{ __('Login now') }}</button>
            </form>

            <h4>or</h4>
            <a href="{{ route('register') }}" class="btn-custom">Sign up</a>
            <a href="{{ route('homes') }}" class="gray-btn">Continue without an account</a>
        </div>
    </div>
</body>

</html>
