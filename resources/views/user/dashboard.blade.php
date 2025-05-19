<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
</head>
<body>
    <h1>User Paneline Hoş Geldiniz</h1>

    <p><strong>Adınız:</strong> {{ Auth::user()->name }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Rol:</strong> {{ Auth::user()->role }}</p>

    <a href="{{ route('logout') }}">Çıkış Yap</a>
</body>
</html>
