<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('app.css')}}">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create an Account</h2>

            <!-- แสดงผลข้อผิดพลาดหากมี -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input id="name" type="text" name="name" placeholder="Name" required>
                <input id="email" type="email" name="email" placeholder="Email Address" required>
                <input id="password" type="password" name="password" placeholder="Password" required minlength="8">
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm Password" required minlength="8">
                <button type="submit">{{ __('Sign up') }}</button>
            </form>
            <a href="{{ route('login') }}" class="gray-btn">Back to login</a>
        </div>
    </div>
</body>
</html>
