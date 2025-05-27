<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <label for="name">Ad Soyad:</label>
        <input type="text" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Şifre:</label>
        <input type="password" name="password" required><br>

        <label for="password_confirmation">Şifre (Tekrar):</label>
        <input type="password" name="password_confirmation" required><br>

        <button type="submit">Kayıt Ol</button>
    </form>
</body>
</html>
