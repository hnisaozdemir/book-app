<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <img src="{{ asset('images/login-logo.png') }}" class="logo" alt="Logo">

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
    @csrf
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Şifre:</label>
    <input type="password" name="password" required><br>

    <label>
        <input type="checkbox" name="remember"> Beni Hatırla
    </label><br>

    <button type="submit">Giriş Yap</button>
</form>

    <p>Üye değil misin? <a href="{{ route('register') }}">Kaydol</a></p>
</body>
</html>