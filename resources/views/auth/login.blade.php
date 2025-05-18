<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Ekranı</h2>

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

        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>